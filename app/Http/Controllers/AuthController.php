<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Traits\RegistersUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use RegistersUsers;
    use AuthenticatesUsers;

    protected function validateRegister(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['same:password'],
        ]);
    }
    protected function validateLogin(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

    protected function registered(Request $request, $user)
    {
        $user->generateToken();

        return response()->json(['data' => $user->toArray()], 201);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = "User";
        $user->password = Hash::make($request['password']);
        $user->save();
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $token = str_replace('Bearer ', '', $token);
        $user = User::where('api_token', $token)->first();
        if($user){
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['data' => 'User logged out.'], 200);
    }
}
