<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Posto;
use App\Presenza;
use App\Utente;
use Illuminate\Http\Request;
use App\Edificio;
use Illuminate\Support\Facades\DB;

class AuleController extends Controller
{
    /**
     * Mostra una lista di tutte le aule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $aule=Aula::all();

        if($aule->isEmpty()){
            return response()->json(["errore"=>"nessuna aula presente"],404);
        }

            foreach ($aule as $aula){
                $edificio = Edificio::findOrFail($aula['id_edificio']);
                $aula['nome_edificio'] = $edificio['nome'];
            }

        return response()->json($aule,200);

    }

    /**
     * Aggiunge un'aula al database e tutti i posti al suo interno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aula = new Aula;
        $aula->codice = $request->codice;
        $aula->capienza = $request->capienza;
        $aula->tipo = $request->tipo;
        $aula->piano = $request->piano;
        $aula->id_edificio = $request->id_edificio;

        $aula -> save();

        $this -> creaPosti($aula);

        return response()->json($aula,201);
    }

    /**
     *
     * Auto generazione dei posti all'interno di un'aula
     * @param $aula
     */
    public function creaPosti($aula){
        for($i=1; $i<= $aula->capienza ;$i++){
            $posto = new Posto;
            $posto->numero_posto = $i;
            $posto->id_aula = $aula->id;
            $posto->save();
        }
    }

    /**
     * Mostra un'aula in base all'ID.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aula= Aula::find($id);
        if($aula == null){
            return response()->json(["errore"=>"aula non trovata"], 404);
        }

        return response()->json($aula, 200);
    }

    /**
     * Mostra un'aula in base al codice.
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function showNome($codice){
        $aula = Aula::where('codice', $codice)->first();
        if($aula == null){
            return response()->json(["errore"=>"aula non trovata"], 404);
        }

        return response()->json($aula, 200);
    }

    /**
     * Registra nel database i cambiamenti all'aula.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $aula = Aula::findOrFail($id);

        $aula->codice = $request->codice;
        $aula->id_edificio = $request->id_edificio;
        $aula->capienza = $request->capienza;
        $aula->stato = $request->stato;
        $aula->tipo = $request->tipo;
        $aula->disponibilita = $request->disponibilita;


        $aula->save();

        return response()->json($aula,200);
    }

    /**
     * Rimuove l'aula specificata dal database
     *
     * @param  \App\Aula  $aula
     * @return \Illuminate\Http\Response
     */
    public function destroy($codice)
    {
        $aula = Aula::findOrFail($codice);
        $aula->delete();

    }

    /**
     * Permette di cambiare lo stato di un'aula da aperta a chiusa e viceversa
     *
     * @param $id_aula
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function stato($id, Request $request){
        $aula = Aula::find($id);

        $aula->stato = $request->stato;
        $aula->save();

        return response()->json($aula,200);
    }

    /**
     * Restituisce tutti i presenti all'interno di una data aula
     *
     * @param $id_aula
     * @return \Illuminate\Http\JsonResponse
     */
    public function presenze($codice){
        $aula = Aula::where('codice', $codice)->first();

        $presenze = Presenza::where('id_aula', $aula->id)
            ->where('data_uscita', null)->get();
        
        $utenti = Utente::where('id', $presenze->id_utente)->get();
        return response()->json($utenti,200);
    }
}
