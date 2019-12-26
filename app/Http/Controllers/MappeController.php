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
        $mappe=Mappa::latest()->get();
        return view('mappe.index',['mappe'=>$mappe]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mappe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $mappa = new Mappa();

        $mappa->piantina= request('piantina');
        $mappa->piano= request('piano');
        $mappa->id= request('id');
        $mappa->save();
        redirect('/mappe');
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
        return view('mappe.show',compact('mappa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mappa= Mappa::find($id);
        return view('mappe.edit',compact('mappa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mappa  $mappa
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $mappa= Mappa::find($id);

        $mappa->piantina= request('piantina');
        $mappa->piano= request('piano');
        $mappa->id= request('id');
        $mappa->save();
        redirect('/mappe');
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
        redirect('/mappe');
    }
}
