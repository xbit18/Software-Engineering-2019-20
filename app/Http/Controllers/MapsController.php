<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\Map;
use App\Building;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\MapCollection;
use App\Http\Resources\Map as MapResource;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maps = new MapCollection(Map::paginate(10));

        if ($maps->isEmpty()) {
            $maps->additional(['error' => 'No map was found!']);

            return $maps->response()->setStatusCode(200);
        } else {
            foreach ($maps as $map) {
                $building = Building::findOrFail($map['building_id']);
                $map['building_name'] = $building['name'];
            }
            $maps->additional(['error' => null]);
        }
        return $maps->response()->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if($user == null){
            return response()->json([
                'data'=>[],
                'error' => "unauthorized"], 401);
        } else if($user->type != 'admin') {
            return response()->json([
                'data'=>[],
                'error' => "forbidden"], 403);
        }

        try {

            $map = new MapResource(Map::where('building_id', $request->building_id)->where('floor', $request->floor)->first());
            if ($map->resource != null) {
                $map->additional(['error' => 'This floor already has a map']);
                return $map->response()->setStatusCode(409);
            }

            $validator = Validator::make($request->all(), [
                'mappa' => 'mimes:jpeg,jpg,png'
            ]);

            if ($validator->fails()) {
                $map->additional(['error' => 'Format not supported']);
                return $map->response()->setStatusCode(415);
            }

            $request->file('map');
            $extension = $request->file('map')->extension();

            $name = "building" . $request->building_id . "floor". $request->floor . "." . $extension;

            $path = $request->map->storeAs('public', $name);

            $url = Storage::url($name);

            $map = new MapResource(Map::create([
                'floor_map' => $url,
                'floor' => $request->floor,
                'building_id' => $request->building_id
            ]));

            $map->additional(['error' => null]);
            return $map->response()->setStatusCode(201);
        } catch(QueryException $ex){
            $map = new MapResource([]);
            $map->additional(['error' => $ex->getMessage()]);
            return $map->response()->setStatusCode(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
     public function showWithFloorAndBuilding($building_id, $floor)
     {
         $map= Map::where('building_id',$building_id)->where('floor',$floor)->first();
         $building = Building::find($building_id);
         $map['address'] = $building->address;

         $mapResource = new MapResource($map);
        if($mapResource->resource == null){
            $mapResource->additional(['error' => 'Map not found!']);

            return $mapResource->response()->setStatusCode(200);
        } else {
            $mapResource->additional(['error' => null]);
        }
         return $mapResource->response()->setStatusCode(200);
     }

    public function show($id)
    {
        $map= new MapResource(Map::find($id));
        if($map->resource == null){
            $map->additional(['error' => 'Map not found!']);

            return $map->response()->setStatusCode(200);
        } else {
            $map->additional(['error' => null]);
        }
        return $map->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $user = auth()->user();

        if($user == null){
            return response()->json([
                'data'=>[],
                'error' => "unauthorized"], 401);
        } else if($user->type != 'admin') {
            return response()->json([
                'data'=>[],
                'error' => "forbidden"], 403);
        }

        try {
            $map = Map::find($id);
            if ($map == null) {
                $map = new MapResource([]);
                $map->additional(['error'=>'Map not found']);
                return $map->response()->setStatusCode(200);
            }

            $validator = Validator::make($request->all(), [
                'mappa' => 'mimes:jpeg,jpg,png'
            ]);

            if ($validator->fails()) {
                $map = new MapResource([]);
                $map->additional(['error'=>'Format not supported']);
                return $map->response()->setStatusCode(415);
            }

            $request->file('map');
            $extension = $request->file('map')->extension();

            $name = "building" . $request->building_id . "floor". $request->floor . "." . $extension;

            Storage::delete($map->floor_map);

            $path = $request->map->storeAs('public', $name);

            $url = Storage::url($name);

            $map->floor_map = $url;
            $map->floor = $request->floor;
            $map->building_id = $request->building_id;

            $map->save();

            $mapResource = new MapResource($map);
            $mapResource->additional(['error' => null]);

            return $mapResource->response()->setStatusCode(200);
        }catch(QueryException $ex){
            $map = new MapResource([]);
            $map->additional(['error' => $ex->getMessage()]);
            return $map->response()->setStatusCode(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Map  $map
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if($user == null){
            return response()->json([
                'data'=>[],
                'error' => "unauthorized"], 401);
        } else if($user->type != 'admin') {
            return response()->json([
                'data'=>[],
                'error' => "forbidden"], 403);
        }

        $map= Map::find($id);

        if($map == null){
            $mapResource = new MapResource($map);
            $mapResource->additional(['error' => 'Map not found!']);
            return $mapResource->response()->setStatusCode(400);
        }

        Storage::delete($map->floor_map);
        $map->delete();

        return response()->json([],204);
    }
}
