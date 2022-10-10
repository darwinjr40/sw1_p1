<?php

namespace App\Http\Controllers;

use App\Models\Aparece;
use App\Models\Event;
use App\Models\Paper;
use App\Models\PaperFile;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaperFileController extends Controller
{

  public function index()
  {
    //
  }

  public function indexPaperFile($paper_id)
  {
    $isLogin = !Auth::guest();
    if (!$isLogin) {
      return redirect()->route('login');
    }
    $user = Auth::user();
    $files = PaperFile::all()->where('paper_id', $paper_id);
    return view('data.paper-file.show-fotografo', compact('files', 'paper_id'));
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    // return Auth::user()->userFiles[0]->url;
    // return $request['files'][0];
    // $request->validate(PaperFile::$rules);
    
    // $data = Http::withHeaders(['Accept' => 'application/json'])
    //               ->attach('files[]', fopen('https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/OH8LGqrT0JPmgVB5BrMjInqdg4SETQFpr5E64XPX.jpg', 'r'))
    //               ->attach('files[]', fopen('https://s3service12.s3.amazonaws.com/sw1_p1/paperFile/1/q9MDJGqpFLizAcBhYwp3r2OCzF3GLLSpUdEn7b7h.jpg', 'r'))
    //               ->async()
    //               ->post('http://localhost/sw1_p1/public/api/subirFile',  ['p1' => 'dsa']);
    //             $data->wait();
    //             // $res = $data->json();
    //             return $data;
    try {
      if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
        $dir = 'sw1_p1/paperFile/' . ($request->paper_id);
        $files = $request->file('files'); //retorna un object con los datos de los archivos
        foreach ($files as $f) {
          $urlP = Storage::disk('s3')->put($dir, $f, 'public');
          $url = Storage::disk('s3')->url($urlP);
          $paperFile = PaperFile::create([
            'url' => $url,
            'urlP' => $urlP,
            'paper_id' => $request->paper_id
          ]);

          $paper = Paper::findOrFail($request->paper_id);
          $a = Event::findOrFail($paper->id);
          $papers = $a->papers;
          foreach ($papers as $p) {
            if ($p->tipo == User::INVITADO) {
              $images = $p->user->userFiles;
              foreach ($images as $i) {
                // return $p->user->userFiles;
                $data = Http::withHeaders(['Accept' => 'application/json'])
                  ->attach('files[]', fopen($i->url, 'r'))
                  ->attach('files[]', fopen($paperFile->url, 'r'))
                  // ->async()
                  ->post('http://localhost/sw1_p1/public/api/subirFile',  ['p1' => 'dsa']);
                $res = $data->json();
                if ($res['data'] == 1) {
                  DB::table('apareces')->insert([
                    'paper_id' => $paperFile->paper_id,
                    'paper_file_id' => $paperFile->id,
                    'url' => $paperFile->url,
                    'urlP' => $paperFile->urlP,
                  ]);                
                  break;
                }
              }
            }
          }
        }
        return back()->with('success', 'se subieron las fotos con exito!');
      }
    } catch (\Throwable $th) {
      return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    }
    return back()->with('success', 'archivo subido con exito');
  }

  public function sendAparece(Request $request): void
  {
    $file = fopen('', 'r');
    $file1 = fopen('', 'r');
    $data = Http::async()->withHeaders(['Accept' => 'application/json'])
      // 'files[]',  file_get_contents($files[0])
      ->attach('files[]', $file)
      ->attach('files[]', $file1)
      ->post('http://localhost/sw1_p1/public/api/subirFile',  ['p1' => 'dsa']);
    // $v = json_decode($data, true);
    $data = $data->json();
    if ($data['data'] == 1) {
      Aparece::create([
        'paper_id' => '',
        'paper_file_id' => '',
        'url' => '',
        'urlP' => '',
      ]);
    }
    // $file = fopen('https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/OH8LGqrT0JPmgVB5BrMjInqdg4SETQFpr5E64XPX.jpg', 'r');
    // $file1 = fopen('https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/KVX04jr6Xx1OSPHki8JLHl2p2As00iTV4RLxGQqc.jpg', 'r');
    // return $data;
    // return $data['data'];
    // $mensaje = (isset($data['data'])) ? 'ERROR rellenar Ubicacion.' : 'EXITO Ubicacion creada.';

  }
  public function show(PaperFile $paperFile)
  {
    //
  }

  public function edit(PaperFile $paperFile)
  {
    //
  }

  public function update(Request $request, PaperFile $paperFile)
  {
    //
  }

  public function destroy(PaperFile $paperFile)
  {
    //
  }

  public function pathToUploadedFile($path, $test = true)
  {
    $filesystem = new Filesystem;
    $name = $filesystem->name($path);
    $extension = $filesystem->extension($path);
    $originalName = $name . '.' . $extension;
    $mimeType = $filesystem->mimeType($path);
    $error = null;
    return new UploadedFile($path, $originalName, $mimeType, $error, $test);
  }
}
