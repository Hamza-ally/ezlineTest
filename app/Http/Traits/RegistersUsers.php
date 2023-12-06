<?php

namespace App\Http\Traits;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers{

    // protected function guard()
    // {
    //     return Auth::guard();
    // }

    public function register(Request $request)
    {
        $this->validateRegister($request->all())->validate();
        event(new Registered($user = $this->store($request->all())));
        // $this->guard()->login($user);
        Auth::guard()->login($user);
        // Auth::attempt($user);
        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }
}