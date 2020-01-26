<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Resources\ClassroomCollection;
use App\Seat;
use App\Attendance;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Building;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Classroom as ClassroomResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Response;

class ClassroomsController extends Controller
{
    /**
     * Mostra una lista di tutte le aule.
     *
     * Restituisce tutte le classi con codice 200 OK oppure
     * restituisce in json un errore con codice 200 OK
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = new ClassroomCollection(Classroom::paginate(10));

        if($classrooms->isEmpty()){
            $classrooms->additional(['error' => 'No classroom was found!']);

            return $classrooms->response()->setStatusCode(200);
        } else {
            foreach ($classrooms as $classroom) {
                $building = Building::findOrFail($classroom['building_id']);
                $classroom['building_name'] = $building['name'];
            }
            $classrooms->additional(['error' => null]);
        }

        return $classrooms->response()->setStatusCode(200);

    }

    /**
     * Aggiunge un'aula al database e tutti i posti al suo interno.
     *
     * Restituisce l'aula inserita con codice 201 oppure
     * restituisce in json l'eccezone SQL con codice 500
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $classroom = new ClassroomResource(Classroom::create([
                'code' => $request->code,
                'availability' => $request->availability,
                'type' => $request->type,
                'capacity' => $request->capacity,
                'state' => $request->state,
                'building_id' => $request->building_id,
                'floor' => $request->floor
            ]));

            $this-> createSeats($classroom);

            $classroom->additional(['error' => null]);
            return $classroom->response()->setStatusCode(201);
        } catch(QueryException $ex){
            $classroom = new ClassroomResource([]);
            $classroom->additional(['error' => $ex->getMessage()]);
            return $classroom->response()->setStatusCode(500);
        }

    }

    /**
     * Auto generazione dei posti all'interno di un'aula
     *
     * @param $classroom
     */
    public function createSeats($classroom){
        for($i=1; $i<= $classroom->capacity ;$i++){
            $seat = new Seat;
            $seat->seat_number = $i;
            $seat->classroom_id = $classroom->id;
            $seat->save();
        }
    }

    /**
     * Mostra un'aula in base all'ID.
     *
     * Restituisce l'aula con codice 200 OK oppure
     * restituisce in json un errore con codice 200 OK
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = new ClassroomResource(Classroom::find($id));
        if($classroom->resource == null){
            $classroom->additional(['error' => 'Classroom not found!']);

            return $classroom->response()->setStatusCode(200);
        } else {
            $classroom->additional(['error' => null]);
        }
        return $classroom->response()->setStatusCode(200);
    }

    /**
     * Mostra un'aula in base al codice.
     *
     * Restituisce un'aula in base al nome con codice 200 OK oppure
     * restituisce in json un errore con codice 200 OK
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function showWithName($code){
        $classroom = new ClassroomResource(Classroom::where('code', $code)->first());

        if($classroom->resource == null){
            $classroom->additional(['error' => 'Classroom not found!']);

            return $classroom->response()->setStatusCode(200);
        } else {
            $classroom->additional(['error' => null]);
        }
        return $classroom->response()->setStatusCode(200);
    }

    /**
     * Registra nel database i cambiamenti all'aula.
     *
     * Restituisce l'aula aggiornata con codice 200 OK oppure
     * restituisce in json un errore con codice 400 oppure
     * restituisce in json l'eccezone SQL con codice 500
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        try {
            $classroom = Classroom::find($id);

            if($classroom == null){
                $classroomResource = new ClassroomResource($classroom);
                $classroomResource->additional(['error' => 'Classroom not found!']);
                return $classroomResource->response()->setStatusCode(400);
            }

            $classroom->code = $request->code;
            $classroom->building_id = $request->building_id;
            $classroom->capacity = $request->capacity;
            $classroom->state = $request->state;
            $classroom->type = $request->type;
            $classroom->availability = $request->availability;
            $classroom->floor = $request->floor;

            $classroom->save();

            $classroomResource = new ClassroomResource($classroom);
            $classroomResource->additional(['error' => null]);

            return $classroomResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            $classroom = new ClassroomResource([]);
            $classroom->additional(['error' => $ex->getMessage()]);
            return $classroom->response()->setStatusCode(500);
        }
    }

    /**
     * Rimuove l'aula specificata dal database
     *
     * Non restituisce nulla con codice 204 oppure
     * restituisce in json un errore con codice 400
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($codice)
    {
        $classroom = Classroom::find($codice);

        if($classroom == null){
            $classroomResource = new ClassroomResource($classroom);
            $classroomResource->additional(['error' => 'Classroom not found!']);
            return $classroomResource->response()->setStatusCode(400);
        }
        $classroom->delete();

        return response()->json([],204);
    }

    /**
     * Permette di cambiare lo stato di un'aula da aperta a chiusa e viceversa
     *
     * Restituisce l'aula aggiornata con codice 200 OK oppure
     * restituisce in json un errore con codice 400 oppure
     * restituisce in json l'eccezone SQL con codice 500
     *
     * @param $id_aula
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function state($id, Request $request){
        try {
            $classroom = Classroom::find($id);

            if($classroom == null){
                $classroomResource = new ClassroomResource($classroom);
                $classroomResource->additional(['error' => 'Classroom not found!']);
                return $classroomResource->response()->setStatusCode(400);
            }

            $classroom->state = $request->state;
            $classroom->save();

            $classroomResource = new ClassroomResource($classroom);
            $classroomResource->additional(['error' => null]);

            return $classroomResource->response()->setStatusCode(200);
            } catch(QueryException $ex){
                return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
       }
    }

    /**
     * Restituisce tutti i presenti all'interno di una data aula
     *
     * Restituisce i dati degli utenti presenti nell'aula con codice 200 OK oppure
     * restituisce in json un errore con codice 200 OK
     *
     * @param $id_aula
     * @return \Illuminate\Http\JsonResponse
     */
    public function attendances($id){
        $attendances = Attendance::where('classroom_id', $id)
            ->where('exit_date', null)->get();

        if($attendances->isEmpty()){
            $users = array();
            $usersCollection = UserResource::collection($users);
            $usersCollection->additional(['error' => "This classroom is empty"]);
            return $usersCollection->response()->setStatusCode(200);
        }

        $users = array();
        foreach($attendances as $attendance){
            $user = User::find($attendance->user_id);
            $users[] = $user;
        }

        $usersCollection = UserResource::collection($users);
        $usersCollection->additional(['error' => null]);
        return $usersCollection->response()->setStatusCode(200);
    }
}
