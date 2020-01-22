<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Seat;
use App\Presence;
use App\User;
use Illuminate\Http\Request;
use App\Building;
use Illuminate\Support\Facades\DB;

class ClassroomsController extends Controller
{
    /**
     * Mostra una lista di tutte le aule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classrooms=Classroom::all();

        if($classrooms->isEmpty()){
            return response()->json(["errore"=>"nessuna aula presente"],404);
        }

            foreach ($classrooms as $classroom){
                $building = Building::findOrFail($classroom['id_edificio']);
                $classroom['nome_edificio'] = $building['nome'];
            }

        return response()->json($classrooms,200);

    }

    /**
     * Aggiunge un'aula al database e tutti i posti al suo interno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = new Classroom;
        $classroom->codice = $request->codice;
        $classroom->capienza = $request->capienza;
        $classroom->tipo = $request->tipo;
        $classroom->piano = $request->piano;
        $classroom->id_edificio = $request->id_edificio;

        $classroom -> save();

        $this -> creaPosti($classroom);

        return response()->json($classroom,201);
    }

    /**
     *
     * Auto generazione dei posti all'interno di un'aula
     * @param $classroom
     */
    public function creaPosti($classroom){
        for($i=1; $i<= $classroom->capienza ;$i++){
            $posto = new Seat;
            $posto->numero_posto = $i;
            $posto->id_aula = $classroom->id;
            $posto->save();
        }
    }

    /**
     * Mostra un'aula in base all'ID.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom= Classroom::find($id);
        if($classroom == null){
            return response()->json(["errore"=>"aula non trovata"], 404);
        }

        return response()->json($classroom, 200);
    }

    /**
     * Mostra un'aula in base al codice.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function showNome($codice){
        $classroom = Classroom::where('codice', $codice)->first();
        if($classroom == null){
            return response()->json(["errore"=>"aula non trovata"], 404);
        }

        return response()->json($classroom, 200);
    }

    /**
     * Registra nel database i cambiamenti all'aula.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->codice = $request->codice;
        $classroom->id_edificio = $request->id_edificio;
        $classroom->capienza = $request->capienza;
        $classroom->stato = $request->stato;
        $classroom->tipo = $request->tipo;
        $classroom->disponibilita = $request->disponibilita;


        $classroom->save();

        return response()->json($classroom,200);
    }

    /**
     * Rimuove l'aula specificata dal database
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($codice)
    {
        $classroom = Classroom::findOrFail($codice);
        $classroom->delete();

    }

    /**
     * Permette di cambiare lo stato di un'aula da aperta a chiusa e viceversa
     *
     * @param $id_aula
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function state($id, Request $request){
        $classroom = Classroom::find($id);

        $classroom->stato = $request->stato;
        $classroom->save();

        return response()->json($classroom,200);
    }

    /**
     * Restituisce tutti i presenti all'interno di una data aula
     *
     * @param $id_aula
     * @return \Illuminate\Http\JsonResponse
     */
    public function presences($codice){
        $classroom = Classroom::where('codice', $codice)->first();

        $presenze = Presence::where('id_aula', $classroom->id)
            ->where('data_uscita', null)->get();

        $utenti = User::where('id', $presenze->id_utente)->get();
        return response()->json($utenti,200);
    }
}
