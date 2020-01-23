<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:api', ['except' => ['login']]);

    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        if (! $token = auth()->attempt($request->only('email','password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = $request->user();
        
            return response()->json([
                        'id' => $user->id,
                    'email' => $user->email,
                    'tipo' => $user->tipo,
                    'nome' => $user->nome,
                    'cognome' => $user->cognome,
                    'corso' => $user->corso,
                    'matricola' => $user->matricola,
                    'data_nascita' => $user->data_nascita,
                    'codice_documento' => $user->codice_documento,
                ]);
       
            }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request){
        $user = User::create([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'corso' => $request->get('corso'),
            'matricola' => $request->get('matricola'),
            'tipo' => $request->get('tipo'),
            'data_nascita' => $request->get('data_nascita'),
            'nome' => $request->get('nome'),
            'cognome' => $request->get('cognome'),
        ]);
    }
}
