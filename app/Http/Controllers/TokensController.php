<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenCollection;
use App\Http\Resources\Token as TokenResource;
use App\Token;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class TokensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tokens = new TokenCollection(Token::all());

        if($tokens->isEmpty()){
            $tokens->additional(['error' => 'No token was found!']);

            return $tokens->response()->setStatusCode(200);
        } else {
            $tokens->additional(['error' => null]);
        }

        return $tokens->response()->setStatusCode(200);
    }

    public function indexWithClassroom($classroom_id){
        $tokens = new TokenCollection(Token::where('classroom_id',$classroom_id)->get());

        if($tokens->isEmpty()){
            $tokens->additional(['error' => 'No token was found!']);

            return $tokens->response()->setStatusCode(200);
        } else {
            $tokens->additional(['error' => null]);
        }

        return $tokens->response()->setStatusCode(200);
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
            $token = new TokenResource(Token::create([
                'code' => substr(str_shuffle(MD5(microtime())), 0, 10),
                'classroom_id' => $request->classroom_id,
                'validity' => $request->validity
            ]));

            $token->additional(['error' => null]);
            return $token->response()->setStatusCode(201);
        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }


    public function createClassroomTokens($classroom){
        for($i = 1; $i<=5; $i++){
            $token = Token::create([
                'code' => substr(str_shuffle(MD5(microtime())), 0, 10),
                'classroom_id' => $classroom->id,
                'validity' => 0
            ]);
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
        $token = new TokenResource(Token::find($id));
        if($token->resource == null){
            $token->additional(['error' => 'Token not found!']);

            return $token->response()->setStatusCode(200);
        } else {
            $token->additional(['error' => null]);
        }
        return $token->response()->setStatusCode(200);
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
        try {
        $token = Token::find($id);

        if($token == null){
            $tokenResource = new TokenResource($token);
            $tokenResource->additional(['error' => 'Token not found!']);
            return $tokenResource->response()->setStatusCode(400);
        }
            $token->code = $request->code;
            $token->classroom_id = $request->classroom_id;
            $token->validity = $request->validity;

            $token->save();
            $tokenResource = new TokenResource($token);
            $tokenResource->additional(['error' => null]);

        return $tokenResource->response()->setStatusCode(200);
        } catch(QueryException $ex){
            return response()->json(['SQL Exception'=>$ex->getMessage()], 500);
        }
    }


    public function changeValidity($classroom_id, $token_id){
        $tokens = Token::where('classroom_id',$classroom_id)->get();

        foreach($tokens as $token){
            if($token->id == $token_id){
                $token->validity = 1;
            } else {
                $token->validity = 0;
            }
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

        $token = Token::find($id);

        if($token == null){
            $tokenResource = new TokenResource($token);
            $tokenResource->additional(['error' => 'Token not found!']);
            return $tokenResource->response()->setStatusCode(400);
        }
        $token->delete();

        return response()->json([],204);
    }
}
