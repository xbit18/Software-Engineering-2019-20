<?php

namespace App\Http\Controllers;

use App\Aula;
use Illuminate\Http\Request;
use App\Edificio;
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

            foreach ($aule as $aula){
                $edificio = Edificio::where('id', $aula['id_edificio'])->first();
                $aula['nome_edificio'] = $edificio['nome'];
            }

        return response()->json(['aule'=>$aule],200);

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

        $aula = Aula::create([
            'codice' => $data['codice'],
            'capienza' => $data['capienza'],
            'tipo' => $data['tipo'],
            'id_edificio' => $data['edificio']
        ]);

        $aula -> save();
        return response()->json(['aula'=>$aula],201);
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
        return response()->json(['aula'=>$aula],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function edit($codice)
    {
        $aula = Aula::findOrFail($codice);
        return view('aule.edit',compact('aula'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->json()->all();

        $aula = Aula::find($data['id']);

        $aula->codice = $data['codice'];
        $aula->id_edificio = $data['id_edificio'];
        $aula->capienza = $data['capienza'];
        $aula->stato = $data['stato'];
        $aula->tipo = $data['tipo'];
        $aula->disponibilita = $data['disponibilita'];


        $aula->save();

        return response()->json(['aula'=>$aula],200);
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
