<?php

namespace App\Http\Controllers;

use App\Edificio;
use Illuminate\Http\Request;

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
        return ['edifici'=>$edifici];
        //return view('edifici.index',['edifici'=>$edifici]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edifici.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $edificio = new Edificio();

        $edificio->id= request('id');
        $edificio->numero= request('numero_aule');
        $edificio->nome= request('nome');
        $edificio->indirizzo= request('indirizzo');
        $edificio->save();
        redirect('/edifici');
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
        return ['edificio'=>$edificio];
        //return view('$edifici.show',['edificio'=>$edificio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edificio= Edificio::findOrFail($id);
        return view('edifici.edit',compact('edificio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Edificio  $edificio
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $edificio= Edificio::findOrFail($id);
        $edificio->id= request('id');
        $edificio->numero= request('numero_aule');
        $edificio->nome= request('nome');
        $edificio->indirizzo= request('indirizzo');
        $edificio->save();
        redirect('/edifici');
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
        redirect('/edifici');
    }
}
