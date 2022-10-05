<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evento=Event::paginate(5);
        return view('data.eventos.index',compact('evento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias=Category::all();
        // $contactos=Contacto::all();
        // $ubicacions = Ubicacion::all();
        return view('data.eventos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Event::$rules);
        Event::create($request->all());
        EventFile::create($request->all());

        if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
            $imagen= [];
            $data = array("evento_id" => $request['evento_id']);
            $files = $request->file('files'); //retorna un object con los datos de los archivos
            foreach ($files as $file) {
                $data['pathPrivate'] = Storage::disk('s3')->put($data['evento_id'], $file, 'public');
                $data['path'] = Storage::disk('s3')->url($data['pathPrivate']);
                // $data['pathPrivate'] = '';
                // $data['path'] = '';
                $imagen[] = $data;
            }
            $request['datos'] = $imagen;
        }
        // $url = config('services.endpoint.service').'/api/imagenes-api';
        // if (isset($response['errors'])) {
        //     return back()->withErrors($response->json()['errors']);
        // } else {
        //     return back()->with('success', $response->json()['message']);
        // }

        return redirect()->route('eventos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
