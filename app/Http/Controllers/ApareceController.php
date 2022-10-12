<?php

namespace App\Http\Controllers;

use App\Models\Aparece;
use App\Models\Event;
use App\Models\Paper;
use App\Models\User;
use Illuminate\Http\Request;

class ApareceController extends Controller
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
  //muestra todos los fotografos para los usuarios
  public function inicioPaper($paper_id)
  {
    $paper = Paper::find($paper_id);
    $evento = Event::find($paper->event_id);
    $fotografos = $evento->papers->where('tipo', User::FOTOGRAFO);
    // return "dsad";
    return view('data.aparece.index-fotografo', compact('fotografos', 'paper_id'));
  }
  //mostrar las fotografias de los usuarios invitados
  public function mostrarFotografias($fotografo_id, $invitado_id)
  {
    $fotografo = Paper::find($fotografo_id);
    $invitado = Paper::find($invitado_id);
    $paperFilesId = $fotografo->paperFiles->pluck('id');
    $apareces = Aparece::all()->where('paper_id', $invitado->id)->whereIn('paper_file_id',$paperFilesId);
    $paper_id =$invitado->id;
    return view('data.aparece.mostrar-fotografias', compact('apareces','paper_id' ));
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
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
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Aparece  $aparece
   * @return \Illuminate\Http\Response
   */
  public function show(Aparece $aparece)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Aparece  $aparece
   * @return \Illuminate\Http\Response
   */
  public function edit(Aparece $aparece)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Aparece  $aparece
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Aparece $aparece)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Aparece  $aparece
   * @return \Illuminate\Http\Response
   */
  public function destroy(Aparece $aparece)
  {
    //
  }
}
