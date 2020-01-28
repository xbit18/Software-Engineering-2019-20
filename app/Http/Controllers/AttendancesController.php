<?php

namespace App\Http\Controllers;

use App\Token;
use DateInterval;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Resources\Attendance as AttendanceResource;
use App\Http\Resources\AttendanceCollection;
use App\Attendance;
use App\Http\Resources\User as UserResource;


class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $attendances = new AttendanceCollection(Attendance::paginate(10));

        if($attendances->isEmpty()){
            $attendances->additional(['error' => 'No attendances were found!']);

            return $attendances->response()->setStatusCode(200);
        } else {
            $attendances->additional(['error' => null]);
        }

        return $attendances->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $user = auth()->user();

        if($user == null){
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "unauthorized"]);         //L'utente non è autenticato
            return $userResource->response()->setStatusCode(401);
        } else if($user->type != 'admin' and $user->type != 'student') {
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "forbidden"]);            //L'utente non ha i permessi giusti
            return $userResource->response()->setStatusCode(403);
        }

        try {
            $user = auth()->user();
            $token = Token::where('code',$request->token)->first();

            if($token->validity != 1){
                $userResource = new UserResource;
                $userResource->additional(['error' => 'The token is not valid']);
                return $userResource->response()->setStatusCode(400);
            }

            $tokens = Token::where('user_id',$user->id)->where('classroom_id',$token->classroom_id)->where('exit_date',null)->get();
            if(!$tokens->isEmpty){
                $userResource = new UserResource;
                $userResource->additional(['error' => 'forbidden multiple check-in']);
                return $userResource->response()->setStatusCode(400);
            }

            $currentDateTime = date('Y-m-d H:i:s');

            $attendance = new AttendanceResource(Attendance::create([
                'entry_date' => $currentDateTime,
                'exit_date' => null,
                'subject' => $request->subject,
                'classroom_id'=> $token->classroom_id,
                'user_id'=> $user->id,
                'confirmation' => 0
            ]));

            $attendance->additional(['error' => null]);
            return $attendance->response()->setStatusCode(201);

        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $attendance = new AttendanceResource(Attendance::find($id));
        if($attendance->resource == null){
            $attendance->additional(['error' => 'Attendance not found!']);

            return $attendance->response()->setStatusCode(200);
        } else {
            $attendance->additional(['error' => null]);
        }
        return $attendance->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
            $attendance = Attendance::find($id);

            if($attendance == null){
                $attendanceResource = new AttendanceResource($attendance);
                $attendanceResource->additional(['error' => 'Attendance not found!']);
                return $attendanceResource->response()->setStatusCode(400);
            }

            $attendance->entry_date = $request->entry_date;
            $attendance->exit_date = $request->exit_date;
            $attendance->subject = $request->subject;
            $attendance->classroom_id = $request->classroom_id;
            $attendance->user_id = $request->user_id;
            $attendance->confirmation = $request->confirmation;

            $attendance->save();

            $attendanceResource = new AttendanceResource($attendance);
            $attendanceResource->additional(['error' => null]);

            return $attendanceResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            $attendance = new AttendanceResource([]);
            $attendance->additional(['error' => $ex->getMessage()]);
            return $attendance->response()->setStatusCode(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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

        $attendance = Attendance::find($id);

        if($attendance == null){
            $attendanceResource = new AttendanceResource($attendance);
            $attendanceResource->additional(['error' => 'Attendance not found!']);
            return $attendanceResource->response()->setStatusCode(400);
        }
        $attendance->delete();

        return response()->json([],204);
    }


    public function checkOut(Request $request){
        $user = auth()->user();

        if($user == null){
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "unauthorized"]);         //L'utente non è autenticato
            return $userResource->response()->setStatusCode(401);
        } else if($user->type != 'admin' and $user->type != 'student') {
            $userResource = new UserResource([]);
            $userResource->additional(['error' => "forbidden"]);            //L'utente non ha i permessi giusti
            return $userResource->response()->setStatusCode(403);
        }

        $user = auth()->user();

        $token = Token::where('code',$request->token)->first();

        $currentDateTime = date('Y-m-d H:i:s');

        $attendance = Attendance::where('user_id',$user->id)->where('classroom_id',$token->classroom_id)->first();

        $attendance->exit_date = $currentDateTime;
        $attendance->confirmation = 1;

        $attendance->save();

    }

    /*
     * L'idea è di fare un foreach sulle presenze, e, se la entry_date è <=
     * alla current-date -10 ore, e la exit_date è null, inserisco la exit_date
     * e lascio confirmation a 0
     *
     * Quando?
     */

    public function automaticCheckOut(){
        $current_date = new DateTime();
        $current_date->sub(new DateInterval('PT10H'));

        $current_date_format = $current_date->format('Y-m-d H:i:s');

        $attendances = Attendance::where('entry_date','<=',$current_date_format)->where('exit_date', null)->get();

        foreach($attendances as $attendance){
            $attendance->exit_date = date('Y-m-d H:i:s');
            $attendance->save();
        }

        //Da terminare
    }
}
