<?php

namespace App\Http\Controllers;

use App\Map;
use App\Building;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps=Map::all();
        foreach ($maps as $map){
            $building = Building::findOrFail($map['id_edificio']);
            $map['nome_edificio'] = $building['nome'];
        }
        return response()->json($maps,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $map= Map::where('id_edificio', $request->id_edificio)->where('piano',$request->piano)->first();
        if($map != null){
            return response()->json(["errore"=>"la mappa per questo piano esiste già"], 409);
        }

        $validator = Validator::make($request->all(), [
            'mappa' => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json(['errore'=>'formato non supportato'], 415);
        }

        $path = $request->file('mappa')->store('img');

        $map = new Map;
        $map->piantina = $path;
        $map->piano = $request->piano;
        $map->id_edificio = $request->id_edificio;
        $map->save();

        return response()->json($map,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
     public function showMapBuilding($id_building, $floor)
     {
         $map= Map::where('id_edificio',$id_building)->where('piano',$floor)->first();
        if($map == null){
             return response()->json(["errore"=>"mappa non trovata"], 404);
         }

         return response()->json($map, 200);
     }

    public function show($id)
    {
        $map= Map::find($id);
        if($map == null){
            return response()->json(["errore"=>"mappa non trovata"], 404);
        }

        return response()->json($map, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update($id_building, $plane, Request $request)
    {
        $map= Map::where('id_edificio',$id_building)->where('piano',$plane)->first();
        if($map == null){
            return response()->json(["errore"=>"mappa non trovata"], 404);
        }

        $validator = Validator::make($request->all(), [
            'mappa' => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json(['errore'=>'formato non supportato'], 422);
        }

        $path = $request->file('mappa')->store('img');

        $map->piantina = $path;
        if($request->piano != null) {$map->piano = $plane;}
        $map->id_edificio = $id_building;

        $map->save();

        return response()->json($map,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $map= Map::find($id);
        $map->delete();
    }
}
