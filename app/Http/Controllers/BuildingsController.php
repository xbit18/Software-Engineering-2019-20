<?php

namespace App\Http\Controllers;

use App\Building;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings=Building::all();
        return response()->json($buildings,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if ($request->filled('numero_aule' && $request->filled('nome') && $request->filled('indirizzo'){
        //     return response()->json([
        //         'error' => 'I campi richiesti non sono stati riempiti'
        //     ],400);
        // } else {
        $building = new Building;
        $building->numero_aule = $request->numero_aule;
        $building->nome = $request->nome;
        $building->indirizzo = $request->indirizzo;

        $building -> save();

        return response()->json($building,201);
       // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building= Building::find($id);
        if($building == null){
            return response()->json(["errore"=>"edificio non trovato"], 404);
        }

        return response()->json($building, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $building= Building::findOrFail($id);

        $building->nome = $request->nome;
        $building->numero_aule = $request->numero_aule;
        $building->indirizzo = $request->indirizzo;

        $building->save();

        return response()->json($building, 200);
    }

    public function aule($id)
    {
        $aule = DB::table('aule')->where('id_edificio', $id)->get();
        return response()->json($aule,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $building = Building::findOrFail($id);
        $building->delete();
    }
}
