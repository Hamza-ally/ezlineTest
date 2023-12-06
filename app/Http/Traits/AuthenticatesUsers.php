<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthenticatesUsers
{
    public function login(Request $request)
    {
        $this->validateLogin($request->all())->validate();
        $credentials = $request->only('email', 'password');
        
        // if ($this->attemptLogin($request)) {
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return response()->json(['data' => 'Invalid Credentials!'], 404);
    }
}
