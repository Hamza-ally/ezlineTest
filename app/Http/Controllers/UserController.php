<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

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
        $roles = Role::all()->toArray();
        return view('users.create', compact('roles'));
    }

    protected function validateNewUser(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:1,2,3'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateNewUser($request->all())->validate();
        $role = Role::where('id', (int)$request->role)->first();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $role->name;
        $user->password = Hash::make("@Password123");
        if($user->save()){
            $userHasRole = $user->assignRole($role);
            if($userHasRole){
                return response()->json(['success' => 'User created!'], 200);
            }else{
                $user->delete();
                return response()->json(['error' => 'User not created!'], 500);
            }
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
        $user = User::where('id', $id)->first();
        $roles = Role::all()->toArray();
        // $user_role = $user->getRoleNames();

        $userroles = $user->roles;
        $user_role = $userroles->pluck('id')->toArray();
        $user = $user->toArray();
        return view('users.edit', compact('user', 'roles', 'user_role'));
    }

    protected function validateEditUser(array $data)
    {
        $userId = $data['id'];
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'role' => ['required', 'in:1,2,3'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $this->validateEditUser($request->all())->validate();
        $this->validateEditUser(array_merge($request->all(), ['id' => $id]))->validate();
        $role = Role::where('id', (int)$request->role)->first();
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make("@Password123");
        $user->role = $role->name;
        if($user->save()){
            $user->assignRole($role);
            return response()->json(['success' => 'User updated!'], 200);
        }
        return response()->json(['error' => 'User not updated!'], 500);
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
