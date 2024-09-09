<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

     /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth('api')->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    public function register(StoreUserRegistrationRequest $request)
    {
        $formData = $request->validated();

        // Create a new user
        $user = User::create([
            'name'     => $formData['name'],
            'email'    => $formData['email'],
            'password' => bcrypt($formData['password']),
        ]);

        // Generate a token for the user
        $token = auth('api')->login($user);

        // Respond with the token
        return $this->respondWithToken($token);
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
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function me() {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

}
