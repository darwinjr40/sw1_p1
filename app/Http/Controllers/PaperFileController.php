<?php

namespace App\Http\Controllers;

use App\Models\Paper;
use App\Models\PaperFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaperFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(PaperFile::$rules);
        try {
            if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
              $dir = 'sw1_p1/paperFile/' . ($request->paper_id);
            //   $dir = 'sw1_p1/event/' . ($request->paper_id);
              $files = $request->file('files'); //retorna un object con los datos de los archivos
              foreach ($files as $f) {
                $urlP = Storage::disk('s3')->put($dir, $f, 'public');
                $url = Storage::disk('s3')->url($urlP);
                PaperFile::create([
                  'url' => $url,
                  'urlP' => $urlP,
                  'paper_id' => $request->paper_id
                ]);
              }
            }
        } catch (\Throwable $th) {
            return back()->withErrors('Algo salio mal!, intentelo mas tarde');
        }        
          return back()->with('success', 'archivo subido con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaperFile  $paperFile
     * @return \Illuminate\Http\Response
     */
    public function show(PaperFile $paperFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaperFile  $paperFile
     * @return \Illuminate\Http\Response
     */
    public function edit(PaperFile $paperFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaperFile  $paperFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaperFile $paperFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaperFile  $paperFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaperFile $paperFile)
    {
        //
    }
}
