<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    protected function validateNewUser(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateNewUser($request->all())->validate();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = "User";
        $user->password = Hash::make("@Password123");
        if($user->save()){
            return response()->json(['success' => 'User created!'], 200);
        }
        return response()->json(['error' => 'User not created!'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return response()->json(['data' => User::where('id', '!=', 1)->orderBy('created_at', 'desc')->get()]);
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
    public function destroy(string $id)
    {
        if($id == 1){
            return response()->json(['error' => 'Internal Server error!'], 500);
        }
        $user = User::where('id', $id)->first();
        if($user->delete()){
            return response()->json(['success' => 'User deleted!'], 200);
        }
        return response()->json(['error' => 'User not deleted!'], 500);
    }
}
