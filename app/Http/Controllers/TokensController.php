<?php

namespace App\Http\Controllers;

use App\Http\Resources\TokenCollection;
use App\Http\Resources\Token as TokenResource;
use App\Token;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
                'code' => $request->code,
                'classroom_id' => $request->classroom_id,
                'validity' => $request->validity
            ]));

            $token->additional(['error' => null]);
            return $token->response()->setStatusCode(201);
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
        //
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
        //
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
        //
    }
}
