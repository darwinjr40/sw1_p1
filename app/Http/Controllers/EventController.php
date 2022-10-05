<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    public function index()
    {
        $evento=Event::paginate(5);
        return view('data.eventos.index',compact('evento'));
    }

    public function create()
    {
        $categorias=Category::all();
        // $contactos=Contacto::all();
        // $ubicacions = Ubicacion::all();
        return view('data.eventos.create',compact('categorias'));
    }

    public function store(Request $request)
    {        
        $request->validate(Event::$rules);
        try {
            if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
                $e = Event::create($request->all());
                // $data = array("evento_id" => $request['evento_id']);
                $dir = 'sw1_p1/event/'.($e->id);
                $files = $request->file('files'); //retorna un object con los datos de los archivos
                foreach ($files as $f) {
                    $url = Storage::disk('s3')->put($dir, $f, 'public');
                    $urlP = Storage::disk('s3')->url($url);
                    EventFile::create([
                        'url' => $url,
                        'urlP' => $urlP,
                        'event_id' => $e->id 
                    ]);
                }
            }
        } catch (\Throwable $th) {
            return back()->withErrors('Algo salio mal!, intentelo mas tarde');
        }
        return redirect()->route('eventos.index');
        //     return back()->with('success', $response->json()['message']);
    }

    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event)
    {
        //
    }

    public function update(Request $request, Event $event)
    {
        //
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return back();
    }
}
