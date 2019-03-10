<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreate;
use App\User;

class UserController extends Controller
{
    public function store(UserCreate $request)
    {
        $user = User::create([
            'name'    => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'jwt',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ], 201);
    }
}
