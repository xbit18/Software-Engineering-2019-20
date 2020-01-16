<?php

namespace App\Http\Controllers;

use App\Aula;
use Illuminate\Http\Request;
use App\Edificio;

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

            foreach ($aule as $aula){
                $edificio = Edificio::findOrFail($aula['id_edificio']);
                $aula['nome_edificio'] = $edificio['nome'];
            }

        return response()->json($aule,200);

    }


    /**
     * Aggiunge un'aula al database.
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
        $aula->id_edificio = $request->id_edificio;

        $aula -> save();

        return response()->json($aula,201);
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
    public function update(Request $request)
    {
        $aula = Aula::findOrFail($request->id);

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

        return response()->json($aula,200);
    }
}
