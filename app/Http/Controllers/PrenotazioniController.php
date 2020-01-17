<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Prenotazione;
use App\Utente;
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
        $prenotazioni=Prenotazione::all();
        foreach($prenotazioni as $prenotazione){
            $aula = Aula::find($prenotazione->id_aula);
            $utente = utente::find($prenotazione->id_utente);

            $prenotazione['codice'] = $aula->codice;
            $prenotazione['nome'] = $utente->nome;
            $prenotazione['cognome'] = $utente->cognome;
        }
        return response()->json($prenotazioni, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prenotazione = new Prenotazione();

        $prenotazione->codice = $request->codice;
        $prenotazione->data_inizio = $request->data_inizio;
        $prenotazione->data_fine = $request->data_fine;
        $prenotazione->motivazione = $request->motivazione;
        $prenotazione->id_aula = $request->id_aula;
        $prenotazione->id_utente = $request->id_utente;
        $prenotazione->save();

        return response()->json($prenotazione, 201);
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

        $aula = Aula::find($prenotazione->id_aula);
        $utente = utente::find($prenotazione->id_utente);

        $prenotazione['codice'] = $aula->codice;
        $prenotazione['nome'] = $utente->nome;
        $prenotazione['cognome'] = $utente->cognome;

        return response()->json($prenotazione,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prenotazione  $prenotazione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prenotazione= Prenotazione::findOrFail($request->id);

        $prenotazione->id= $request->codice;
        $prenotazione->data_inizio= $request->data_inizio;
        $prenotazione->data_fine= $request->data_fine;
        $prenotazione->motivazione= $request->motivazione;
        $prenotazione->stato= $request->stato;
        $prenotazione->save();

        return response()->json($prenotazione,200);
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

        return response()->json($prenotazione,200);
    }
}
