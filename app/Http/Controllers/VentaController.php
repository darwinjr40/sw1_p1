<?php

namespace App\Http\Controllers;

use App\Models\Aparece;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
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

    public function preCreate()
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
        // return $request;

        $f = $request['paper_id']; //paper_file   : invitado
        $p = json_decode($request['b'], true); //paperFileId :array
        $apareces =  Aparece::all()->Where('paper_id', $f)->whereIn('paper_file_id', $p);
        if ($p) {
        } else {
        }
        
        $v = Venta::create([
          'cliente' => isset($request['cliente']) ?  $request['cliente'] : null,
          'nit' => isset($request['nit']) ?  $request['nit'] : null,
          'fecha' => isset($request['fecha']) ?  $request['fecha'] : null,
          'total' => isset($request['total']) ?  $request['total'] : null,
          'pago' => isset($request['pago']) ?  $request['pago'] : null,
        ]);
        foreach ($apareces as $a) {          
          $a->venta_id = $v->id;
          // $ap = Aparece::where('paper_id', $a->paper_id)->where('paper_file_id', $a->paper_file_id)->first();
          // $ap->venta_id = 1;

           $a->save();
        }
        return redirect()->route('aparece.inicioPaper', ['paper_id' => $f ]);
    }

    public function preStore(Request $request)
    {
        $p = $request->paper_id;
        $b = $request->b;
        return view('data.ventas.create', compact('b', 'p'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
