<?php

namespace App\Http\Controllers;

use App\Models\EventFile;
use Illuminate\Http\Request;

class EventFileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function index()
    {
        //
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
     * @param  \App\Models\EventFile  $eventFile
     * @return \Illuminate\Http\Response
     */
    public function show(EventFile $eventFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventFile  $eventFile
     * @return \Illuminate\Http\Response
     */
    public function edit(EventFile $eventFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventFile  $eventFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventFile $eventFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventFile  $eventFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventFile $eventFile)
    {
        //
    }
}
