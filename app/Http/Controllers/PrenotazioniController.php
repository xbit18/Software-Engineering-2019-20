<?php

namespace App\Http\Controllers;

use App\Prenotazione;
use Illuminate\Http\Request;

class PrenotazioniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prenotazione=Prenotazione::all();
        return ['prenotazioni'=>$prenotazione];
        //return view('prenotazioni.index',['prenotazioni'=>$prenotazione]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prenotazioni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $prenotazioni = new Prenotazione();

        $prenotazioni->codice= request('codice');
        $prenotazioni->data= request('data');
        $prenotazioni->dutrata= request('durata');
        $prenotazioni->motivazione= request('motivazione');
        $prenotazioni->stato= request('stato');
        $prenotazioni->save();
        redirect('/prenotazioni');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $prenotazione= Prenotazione::findOrFail($id);
        return ['prenotazione'=>$prenotazione];
        //return view('prenotazioni.show',['prenotazione'=>$prenotazione]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prenotazione= Prenotazione::findOrFail($id);
        return view('prenotazioni.edit',compact('prenotazione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $prenotazioni= Prenotazione::findOrFail($id);

        $prenotazioni->id= request('id');
        $prenotazioni->data= request('data');
        $prenotazioni->dutrata= request('durata');
        $prenotazioni->motivazione= request('motivazione');
        $prenotazioni->stato= request('stato');
        $prenotazioni->save();
        redirect('/prenotazioni');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
         $prenotazione= Prenotazione::findOrFail($id);
        $prenotazione->delete();
        redirect('/prenotazioni');
    }
}
