<?php

namespace App\Http\Controllers;

use App\Building;
use App\Classroom;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BuildingCollection;
use App\Http\Resources\Building as BuildingResource;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $buildings = new BuildingCollection(Building::paginate(10));

            if($buildings->isEmpty()){
                $buildings->additional(['error' => 'No building was found!']);

                return $buildings->response()->setStatusCode(200);
            } else {
                $buildings->additional(['error' => null]);
            }

            return $buildings->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if($user == null){
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "unauthorized"]);         //L'utente non è autenticato
            return $userResource->response()->setStatusCode(401);
        } else if($user->type != 'admin') {
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "forbidden"]);            //L'utente non ha i permessi giusti
            return $userResource->response()->setStatusCode(403);
        }


        try {
            $building = new BuildingResource(Building::create([
                'total_classrooms' => $request->total_classrooms,
                'name' => $request->name,
                'address' => $request->address
            ]));

            $building->additional(['error' => null]);
            return $building->response()->setStatusCode(201);
        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building = new BuildingResource(Building::find($id));
        if($building->resource == null){
            $building->additional(['error' => 'Building not found!']);

            return $building->response()->setStatusCode(200);
        } else {
            $building->additional(['error' => null]);
        }
        return $building->response()->setStatusCode(200);
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
        $user = auth()->user();

        if($user == null){
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "unauthorized"]);         //L'utente non è autenticato
            return $userResource->response()->setStatusCode(401);
        } else if($user->type != 'admin') {
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "forbidden"]);            //L'utente non ha i permessi giusti
            return $userResource->response()->setStatusCode(403);
        }

        try {
            $building = Building::find($id);

            if($building == null){
                $buildingResource = new BuildingResource($building);
                $buildingResource->additional(['error' => 'Building not found!']);
                return $buildingResource->response()->setStatusCode(400);
            }
            $building->name = $request->name;
            $building->total_classrooms = $request->total_classrooms;
            $building->address = $request->address;

            $building->save();
            $buildingResource = new BuildingResource($building);
            $buildingResource->additional(['error' => null]);

            return $buildingResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }

    public function classrooms($id)
    {
        $classrooms = Classroom::collection(DB::table('classrooms')->where('id_building', $id)->get());
        return $classrooms->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if($user == null){
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "unauthorized"]);         //L'utente non è autenticato
            return $userResource->response()->setStatusCode(401);
        } else if($user->type != 'admin') {
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "forbidden"]);            //L'utente non ha i permessi giusti
            return $userResource->response()->setStatusCode(403);
        }

        $building = Building::find($id);

        if($building == null){
            $buildingResource = new BuildingResource($building);
            $buildingResource->additional(['error' => 'Building not found!']);
            return $buildingResource->response()->setStatusCode(400);
        }
        $building->delete();

        return response()->json([],204);
    }
}
