<?php

namespace App\Http\Controllers;

use App\Aula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $aule=Aula::all();
        return ['aule'=>$aule];
        // return view('aule.index',['aule'=>$aule]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $id_edifici = DB::table('edificio')->select('id')->where('nome','=',$data['edificio'])->get();
        $id_edificio = $id_edifici[0].value();
        var_dump($id_edificio);
        die();

        /*
        $aula = Aula::create([
            'codice' => $data['codice'],
            'capienza' => $data['capienza'],
            'tipo' => $data['tipo'],
            'edificio' => $data['edificio']
        ]);

        $aula -> save();
        return response()->json(['aula'=>$aula],201);
       // redirect('/aule'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function show($codice)
    {
        $aula= Aula::findOrFail($codice);
        return ['aula'=>$aula];
        //return view('aule.show',['aula'=>$aula]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function edit($codice)
    {
        $aula= Aula::findOrFail($codice);
        return view('aule.edit',compact('aula'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function update($codice)
    {
        $aula= Aula::findOrFail($codice);
        $aula->codice= request('codice');
        $aula->capienza= request('capienza');
        $aula->tipo= request('tipo');
        $aula->disponibilita= request('disponibilita');
        $aula->save();
        redirect('/aule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function destroy($codice)
    {
        $aula = Aula::findOrFail($codice);
        $aula->delete();
    }
}
