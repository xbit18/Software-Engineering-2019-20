<?php

namespace App\Http\Controllers;

use App\Edificio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdificiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edifici=Edificio::all();
        return response($edifici,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $edificio = new Edificio;

        $edificio->numero_aule = $request->numero_aule;
        $edificio->nome = $request->nome;
        $edificio->indirizzo = $request->indirizzo;

        $edificio -> save();

        return response()->json(['edificio'=>$edificio],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edificio= Edificio::findOrFail($id);
        return response()->json(['edificio'=>$edificio], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $edificio= Edificio::findOrFail($request->id);

        $edificio->nome= $request->nome;
        $edificio->numero= $request->numero_aule;
        $edificio->indirizzo= $request->indirizzo;
        dd($edificio);
        //$edificio->save();

        //return response()->json(['edificio'=>$edificio], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edificio= Edificio::findOrFail($id);
        $edificio->delete();
      //  redirect('/edifici');
    }
}
