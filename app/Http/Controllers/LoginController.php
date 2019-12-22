<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function check(){
        request()->validate([
            'email' => 'required',
            'passwd' => 'required',
        ]);




        $user = new User();

        $user->email = request('email');
        $user->passwd = request('passwd');

        $userdb = DB::table('users')->where([
            ['email', $user->email],
            ['password', $user->passwd],
        ])->first();

        if(! $userdb){
            return back()->withInput();
        } else {
            return view('homepage');
        }
    }
}
