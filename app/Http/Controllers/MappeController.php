<?php

namespace App\Http\Controllers;

use App\Mappa;
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
        return response()->json($mappe,200);
        //return ['mappe'=>$mappe];
        //return view('mappe.index',['mappe'=>$mappe]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $mappa = new Mappa();

        $mappa->piantina= request('piantina');
        $mappa->piano= request('piano');
        $mappa->id= request('id');
        $mappa->id_edificio = $request->id_edificio;
        $mappa->save();
        return response()->json($mappa,201);
    }

    public function upload(Request $request)
    {
        $path = $request->file('mappa')->store('/public/mappe');

        return response()->json($path, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request)
    {
        $mappa= Mappa::findOrFail($request->id);

        $mappa->piantina= $request->piantina;
        $mappa->piano= $request->piano;
        $mappa->id= $request->id;
        $mappa->id_edificio= $request->id_edificio;
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
        $mappa= Mappa::findOrFail($id);
        $mappa->delete();
        return response()->json($mappa,200);
    }
}
