<?php

namespace App\Http\Controllers;

use App\Http\Traits\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Traits\RegistersUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $roles = ['Admin' => "1", "Elevated User" => "2", "User" => "3"];
        $role = Role::where('id', $roles[$request->role])->first();
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = "User";
        $user->password = Hash::make($request['password']);
        $user->save();
        $user->assignRole($role);
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
        if($request->wantsJson()){
            $token = $request->header('Authorization');
            if (!$token) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            $token = str_replace('Bearer ', '', $token);
            $user = User::where('api_token', $token)->first();
        }
        $user = Auth::user();
        if($user){
            $user->api_token = null;
            $user->save();
        }
        Auth::logout();
        if($request->wantsJson()) return response()->json(['data' => 'User logged out.'], 200);
        else return redirect()->route('login');
        
    }
}
