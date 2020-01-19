<?php

namespace App\Http\Controllers;

use App\Mappa;
use App\Edificio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MappeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mappe=Mappa::all();
        foreach ($mappe as $mappa){
            $edificio = Edificio::findOrFail($mappa['id_edificio']);
            $mappa['nome_edificio'] = $edificio['nome'];
        }
        return response()->json($mappe,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mappa= Mappa::where('id_edificio', $request->id_edificio)->where('piano',$request->piano)->first();
        if($mappa != null){
            return response()->json(["errore"=>"la mappa per questo piano esiste già"], 409);
        }

        $validator = Validator::make($request->all(), [
            'mappa' => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json(['errore'=>'formato non supportato'], 415);
        }

        $path = $request->file('mappa')->store('img');

        $mappa = new Mappa;
        $mappa->piantina = $path;
        $mappa->piano = $request->piano;
        $mappa->id_edificio = $request->id_edificio;
        $mappa->save();

        return response()->json($mappa,201);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
     public function show_mappa_edificio($id_edificio, $piano)
     {
         $mappa= Mappa::where('id_edificio',$id_edificio)->where('piano',$piano)->first();
        if($mappa == null){
             return response()->json(["errore"=>"mappa non trovata"], 404);
         }

         return response()->json($mappa, 200);
     }

    public function show($id)
    {
        $mappa= Mappa::find($id);
        if($mappa == null){
            return response()->json(["errore"=>"mappa non trovata"], 404);
        }

        return response()->json($mappa, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
    public function update($id_edificio, $piano, Request $request)
    {
        $mappa= Mappa::where('id_edificio',$id_edificio)->where('piano',$piano)->first();
        if($mappa == null){
            return response()->json(["errore"=>"mappa non trovata"], 404);
        }

        $validator = Validator::make($request->all(), [
            'mappa' => 'mimes:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response()->json(['errore'=>'formato non supportato'], 422);
        }

        $path = $request->file('mappa')->store('img');

        $mappa->piantina = $path;
        if($request->piano != null) {$mappa->piano = $piano;}
        $mappa->id_edificio = $id_edificio;

        $mappa->save();

        return response()->json($mappa,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mappa= Mappa::find($id);
        $mappa->delete();
    }
}
