<?php

namespace App\Http\Controllers;

use App\Models\Aparece;
use App\Models\Event;
use App\Models\Paper;
use App\Models\PaperFile;
use App\Models\User;
use AWS\CRT\HTTP\Response;
use GuzzleHttp\Promise\Utils;
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

  public function store1(Request $request)
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
        }
        return back()->with('success', 'se subieron las fotos con exito!');
      }
    } catch (\Throwable $th) {
      return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    }
    return back()->with('success', 'archivo subido con exito');
  }
  public function storeAparece(Request $request)
  {
    try {
      $paper = Paper::findOrFail($request->paper_id);
      $event = Event::findOrFail($paper->event_id);
      $paperFiles = PaperFile::all()->where('paper_id', $paper->id);
      $papersInvitado = $event->papers->where('tipo', User::INVITADO);
      foreach ($paperFiles as $paperFile) {
        foreach ($papersInvitado as $p) {
          $aparece = Aparece::Where('paper_id', $p->id)->where('paper_file_id', $paperFile->id)->first();
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
                'paper_id' => $p->user->id,
                'paper_file_id' => $paperFile->id,
                'url' => $paperFile->url,
                'urlP' => $paperFile->urlP,
              ]);
              break;
            }
          }
        }
      }
    } catch (\Throwable $th) {
      return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    }
    return back()->with('success', 'archivos identificados');
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


  public function store(Request $request)
  {
    // $data= [];
    // return "nise";
    // return env('APP_SERVICE', 'http://127.0.0.1');
    // return config('services.endpoint.service');
    // return env('AWS_DEFAULT_REGION');
    // for ($i=0; $i < 3; $i++) { 
    //   $data[] = Http::withHeaders(['Accept' => 'application/json'])
    //     ->async()
    //     ->attach('files[]', fopen('https://s3service12.s3.amazonaws.com/sw1_p1/userFile/7/OH8LGqrT0JPmgVB5BrMjInqdg4SETQFpr5E64XPX.jpg', 'r'))
    //     ->attach('files[]', fopen('https://s3service12.s3.amazonaws.com/sw1_p1/paperFile/1/q9MDJGqpFLizAcBhYwp3r2OCzF3GLLSpUdEn7b7h.jpg', 'r'))
    //     ->post('http://localhost/sw1_p1/public/api/subirFile1',  ['p1' => 'dsa']);
    //   // ->then(function ($response) {
    //   //     // echo 'I completed! ' . $response->getBody();
    //   //     return $response->getBody();
    //   // });
    // }
    // $responses = Utils::unwrap($data);
    // sleep(6);
    // return "nise1";
    //               // $data->wait();
    try {
      if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
        $paper = Paper::findOrFail($request->paper_id);
        $event = Event::findOrFail($paper->event_id);
        $papersI = $event->papers->where('tipo', User::INVITADO);
        
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

          $a = 0;
          $c = '';
          $c1 = '';
          foreach ($papersI as $p) {
            $images = $p->user->userFiles;
            foreach ($images as $i) {
              $a = $a + 1;
              $res = Http::withHeaders(['Accept' => 'application/json'])
                // ->async()
                ->attach('files[]', fopen($i->url, 'r'))
                ->attach('files[]', fopen($paperFile->url, 'r'))
                ->post(env('APP_SERVICE', 'http://127.0.0.1/sw1_p1/public').'/api/subirFile',  [
                  'paper_id' => $p->id,
                  'paper_file_id' => $paperFile->id,
                  'url' => $paperFile->url,
                  'urlP' => $paperFile->urlP,
                ]);
                // ->then(function ($response) {
                //   //                   // echo 'I completed! ' . $response->getBody();
                //   // return $response->getBody();
                // });;

              // $res = $data->json();
              $c = $c . $res['data'] . '#####';
              $c1 = $c1 . $i->url . '#####';
              //   $c1 .= $i->url.'---'.$paperFile->url.';';
              if ($res['data'] == 1) {
              //   // $c .= $i->url.'---'.$paperFile->url.';';
                DB::table('apareces')->insert([
                  'paper_id' => $p->id,
                  'paper_file_id' => $paperFile->id,
                  'url' => $paperFile->url,
                  'urlP' => $paperFile->urlP,
                ]);
                break;
              }
            }
          }
        }
        return $a . '///' . $c . '$$$$$' . $c1;
        // return $a;
        return back()->with('success', 'se subieron las fotos con exito!');
      }
    } catch (\Throwable $th) {
      return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    }
    // Utils::unwrap($promises);
    return back()->with('success', 'archivo subido con exito');
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
