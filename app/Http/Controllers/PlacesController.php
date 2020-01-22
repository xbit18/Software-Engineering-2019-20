<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return response()->json($places, 200);
    }

    public function index_aula($id){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = new Place;

        $place->numero_posto = $request->numero_posto;

        if($request->disponibilita != null){
            $place->disponibilita = $request->disponibilita;
        }

        $place->id_utente = $request->id_utente;
        $place->id_aula = $request->id_aula;

        $place->save();

        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        if($place == null){
            return response()->json(["errore"=>"posto non trovato"], 404);
        }

        return response()->json($place, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $place->numero_posto = $request->numero_posto;
        $place->id_aula = $request->id_aula;

        $place->save();

        return response()->json($place,200);
    }

    public function state($id,Request $request)
    {
        $place = Place::find($id);
        if($place == null){
            return response()->json(["errore"=>"Classroom non trovata"],404);
        }
        $place->disponibilita = $request->disponibilita;
        $place->id_utente = $request->id_utente;
        $place->save();

        return response()->json($place,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
    }
}
