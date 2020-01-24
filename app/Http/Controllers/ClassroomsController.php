<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Resources\ClassroomCollection;
use App\Seat;
use App\Attendance;
use App\User;
use Illuminate\Http\Request;
use App\Building;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Classroom as ClassroomResource;
use Illuminate\Http\Response;

class ClassroomsController extends Controller
{
    /**
     * Mostra una lista di tutte le aule.
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    }

    /**
     *
     * Auto generazione dei posti all'interno di un'aula
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
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function showNome($code){
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $classroom = Classroom::find($id);

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
        return $classroomResource;
        //return response()->json($classroom,200);
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

        return response()->json([],204);
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

        $presenze = Attendance::where('id_aula', $classroom->id)
            ->where('data_uscita', null)->get();

        $utenti = User::where('id', $presenze->id_utente)->get();
        return response()->json($utenti,200);
    }
}
