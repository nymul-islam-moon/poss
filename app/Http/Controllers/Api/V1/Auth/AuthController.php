<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ChangePasswordRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\StoreUserRegistrationRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Retrieve the token expiration time
            $tokenExpiresIn = JWTAuth::factory()->getTTL() * 60; // in seconds
            

            return response()->json([
                'token' => $token,
                'expires_in' => $tokenExpiresIn,
                'token_type' => 'bearer'
            ]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
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

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
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

    public function me() {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Your are unauthorized'], 401);
        }
        return response()->json($user);
    }
    

    public function change_password(ChangePasswordRequest $request)
    {
        // Validate the request
        $formData = $request->validated();

        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Check if the user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the provided old password matches the current password
        if (!\Hash::check($formData['old_password'], $user->password)) {
            return response()->json(['error' => 'The provided old password is incorrect.'], 401);
        }

        // Update the password
        $user->password = bcrypt($formData['new_password']);
        $user->save();

        // Respond with a success message
        return response()->json(['message' => 'Password successfully updated.']);
    }

    public function test() {
        return response()->json(['success' => 'Test Successfully Updated'], 200);
    }

    public function country_index() {
        $countries = Country::where('is_active', 1)->get();

        return CountryResource::collection($countries);
    }
}
