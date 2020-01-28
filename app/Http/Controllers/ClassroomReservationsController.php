<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\ClassroomReservation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\ClassroomReservation as ClassroomReservationResource;
use App\Http\Resources\ClassroomReservationCollection;

class ClassroomReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classroomsreservations = new ClassroomReservationCollection(ClassroomReservation::paginate(10));

        if($classroomsreservations->isEmpty()){
            $classroomsreservations->additional(['error' => 'No classroom was found!']);

            return $classroomsreservations->response()->setStatusCode(200);
        } else {
            $classroomsreservations->additional(['error' => null]);
        }

        return $classroomsreservations->response()->setStatusCode(200);
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $classroomsreservations = new ClassroomReservationResource(ClassroomReservation::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'motivation' => $request->motivation,
                'classroom_id' => $request->classroom_id,
                'user_id' => $request->user_id
            ]));
            $classroomsreservations->additional(['error' => null]);
            return $classroomsreservations->response()->setStatusCode(201);
        } catch(QueryException $ex){
            $classroomsreservations = new ClassroomReservationResource([]);
            $classroomsreservations->additional(['error' => $ex->getMessage()]);
            return $classroomsreservations->response()->setStatusCode(500);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroomsreservation = new ClassroomReservationResource(ClassroomReservation::find($id));
        if($classroomsreservation->resource == null){
            $classroomsreservation->additional(['error' => 'Classroom not found!']);

            return $classroomsreservation->response()->setStatusCode(200);
        } else {
            $classroomsreservation->additional(['error' => null]);
        }
        return $classroomsreservation->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        try {
            $classroomsreservation = ClassroomReservation::find($id);

            if($classroomsreservation == null){
                $classroomsreservationResource = new ClassroomReservationResource($classroomsreservation);
                $classroomsreservationResource->additional(['error' => 'Classroom not found!']);
                return $classroomsreservationResource->response()->setStatusCode(400);
            }

            $classroomsreservation->start_date = $request->start_date;
            $classroomsreservation->end_date = $request->end_date;
            $classroomsreservation->motivation = $request->motivation;
            $classroomsreservation->state = $request->state;
            $classroomsreservation->classroom_id = $request->classroom_id;
            $classroomsreservation->user_id = $request->user_id;
            $classroomsreservation->save();

            $classroomsreservationResource = new ClassroomReservationResource($classroomsreservation);
            $classroomsreservationResource->additional(['error' => null]);

            return $classroomsreservationResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            $classroomsreservation = new ClassroomResource([]);
            $classroomsreservation->additional(['error' => $ex->getMessage()]);
            return $classroomsreservation->response()->setStatusCode(500);
        }
    }

    /**
     * Permette di cambiare lo stato di una prenotazione da in attesa a accettata o rifiutata e viceversa
     *
     * @param $id_prenotazione
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function state($id, Request $request){
        try {
            $classroomsreservation = ClassroomReservation::find($id);

            if($classroomsreservation == null){
                $classroomsreservationResource = new ClassroomReservationResource($classroomsreservation);
                $classroomsreservationResource->additional(['error' => '$classrooms reservation not found!']);
                return $classroomsreservationResource->response()->setStatusCode(400);
            }

            $classroomsreservation->state = $request->state;
            $classroomsreservation->save();

            $classroomsreservationResource = new ClassroomReservationResource($classroomsreservation);
            $classroomsreservationResource->additional(['error' => null]);

            return $classroomsreservationResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassroomReservation  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $classroomsreservation = ClassroomReservation::find($id);

    if($classroomsreservation == null){
        $classroomsreservationResource = new ClassroomReservationResource($classroomsreservation);
        $classroomsreservationResource->additional(['error' => '$classroomsreservation not found!']);
        return $classroomsreservationResource->response()->setStatusCode(400);
    }
        $classroomsreservation->delete();

    return response()->json([],204);
    }
}
