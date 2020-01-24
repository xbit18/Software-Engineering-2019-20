<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassroomReservation;
use App\User;
use Illuminate\Http\Request;

class ClassroomReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings=ClassroomReservation::all();
        foreach($bookings as $booking){
            $classroom = Classroom::find($booking->id_aula);
            $user = User::find($booking->id_utente);

            $booking['codice'] = $classroom->codice;
            $booking['nome'] = $user->nome;
            $booking['cognome'] = $user->cognome;
        }

        return response()->json($bookings, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new ClassroomReservation();

        $booking->data_inizio = $request->data_inizio;
        $booking->data_fine = $request->data_fine;
        $booking->motivazione = $request->motivazione;
        $booking->id_aula = $request->id_aula;
        $booking->id_utente = $request->id_utente;
        $booking->save();

        return response()->json($booking, 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $booking= ClassroomReservation::findOrFail($id);

        $classroom = Classroom::find($booking->id_aula);
        $user = User::find($booking->id_utente);

        $booking['codice'] = $classroom->codice;
        $booking['nome'] = $user->nome;
        $booking['cognome'] = $user->cognome;

        return response()->json($booking,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $booking= ClassroomReservation::findOrFail($request->id);

        $booking->id= $request->codice;
        $booking->data_inizio= $request->data_inizio;
        $booking->data_fine= $request->data_fine;
        $booking->motivazione= $request->motivazione;
        $booking->stato= $request->stato;
        $booking->save();

        return response()->json($booking,200);
    }

    /**
     * Permette di cambiare lo stato di una prenotazione da in attesa a accettata o rifiutata e viceversa
     *
     * @param $id_prenotazione
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function state($id_prenotazione, Request $request){
        $booking = ClassroomReservation::find($id_prenotazione);

        $booking->stato = $request->stato;
        $booking->save();

        return response()->json($booking,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $booking= ClassroomReservation::findOrFail($id);
        $booking->delete();
    }
}
