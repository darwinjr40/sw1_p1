<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventFile;
use App\Models\Paper;
use App\Models\PaperFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  
  public function index()
  {
    // $evento = Event::paginate(5);
    $evento = Auth::user()->eventos;
    return view('data.eventos.index', compact('evento'));
  }

  public function create()
  {
    $categorias = Category::all();
    // $contactos=Contacto::all();
    // $ubicacions = Ubicacion::all();
    
    return view('data.eventos.create', compact('categorias'));
  }

  public function store(Request $request)
  {
    $request->validate(Event::$rules);
    // try {
    if ($request->hasFile('files')) {  //existe un archivo con nombre <files>
      $request['user_id'] = Auth::user()->id;
      $e = Event::create($request->all());
      // $data = array("evento_id" => $request['evento_id']);
      $dir = 'sw1_p1/event/' . ($e->id);
      $files = $request->file('files'); //retorna un object con los datos de los archivos
      foreach ($files as $f) {

        $urlP = Storage::disk('s3')->put($dir, $f, 'public');
        $url = Storage::disk('s3')->url($urlP);
        EventFile::create([
          'url' => $url,
          'urlP' => $urlP,
          'event_id' => $e->id
        ]);
      }
    }
    // } catch (\Throwable $th) {
    //   return back()->withErrors('Algo salio mal!, intentelo mas tarde');
    // }
    return redirect()->route('eventos.index');
    //     return back()->with('success', $response->json()['message']);
  }

  public function show($id)
  {
    $isLogin = !Auth::guest();
    if (!$isLogin) {
      return redirect()->route('login');
    }
    $event = Event::findOrFail($id);
    $user = Auth::user();
    if ($user->id == $event->user->id) {
      return "es el que inicio el evento";
    }
    $papers = $event->papers->where('user_id', $user->id)->first();
    // $papers = Paper::all()->whereIn('event_id', Event::all()->where('id', $event->id)->pluck('id'))->whereIn('user_id', User::all()->where('id', $user->id)->pluck('id'));
    // return $papers;
    if ($papers) {
      $paper_id = $papers->id;
      if ($papers->tipo == User::FOTOGRAFO) {
        return redirect()->route('papers.indexFotografo', ['paper_id' => $paper_id]);        
        // $files = PaperFile::all();
        // return view('data.eventos.show-fotografo', compact('files'));
        // return "es fotografo";
      } else {
        // return "es Invitado";
        // return $papers;
        return redirect()->route('aparece.inicioPaper', ['paper_id' => $paper_id, ]);
      }
    }
    return "no puede acceder al evento";
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

  public function tienda()
  {
    // $eventos=Event::where('estado','inicio')->get();
    $eventos = Event::all();
    $eventos->load('files'); //carga la relacion files
    // return $eventos;
    // return $eventos;
    // return $eventos;//[0]['imagenes'][0];
    // $buscador=Evento::where('estado','inicio')->pluck('id','titulo');
    // Session::put('eventos', json_encode($buscador));
    return view("data.eventos.showcliente", compact('eventos'));
  }
}
