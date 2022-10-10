<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\PaperFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    try {
      if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
        $dir = 'sw1_p1/paperFile/' . ($request->paper_id);
        $files = $request->file('files'); //retorna un object con los datos de los archivos
        // foreach ($files as $f) {
        //   $urlP = Storage::disk('s3')->put($dir, $f, 'public');
        //   $url = Storage::disk('s3')->url($urlP);
        //   PaperFile::create([
        //     'url' => $url,
        //     'urlP' => $urlP,
        //     'paper_id' => $request->paper_id
        //   ]);
        // }
        // $data = Http::attach(
        //   // 'files', file_get_contents($files)
        //   'attachment', file_get_contents($files)
        // )->post('http://localhost/sw1_p1/public/api/subirFile',  $request->all());
        $data = Http::withHeaders([
          'Content-Type' => 'multipart/form-data',
        ])->attach('files', $request->file('files'))
        ->post('http://localhost/sw1_p1/public/api/subirFile', $request->all());
        // return $data;
        $data = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('http://localhost/sw1_p1/public/api/subirFile', $request->all());
        // $v = json_decode($data, true);
        $data = $data->json();
        return $data['data'];
        $mensaje = (isset($data['data']))? 'ERROR rellenar Ubicacion.' : 'EXITO Ubicacion creada.';
        return back()->with('success', $mensaje);
      }
    } catch (\Throwable $th) {
      return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    }
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
}
