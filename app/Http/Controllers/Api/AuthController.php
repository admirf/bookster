<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'address' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        User::create($attributes);

        return response()->json([
            'status' => 'Success'
        ], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if (! $token = auth()->attempt($credentials)) {
            throw new AuthenticationException();
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return new UserResource(auth()->user()->load('roles'));
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 168
        ]);
    }
}
