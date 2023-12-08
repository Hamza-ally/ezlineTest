<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('roles.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    protected function validateCreateRole(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'unique:roles', 'max:16'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateCreateRole($request->all())->validate();
        $role = Role::create(['name' => $request->name]);
        if($role){
            return response()->json(['success' => 'Role created!'], 200);
        }
        return response()->json(['error' => 'Role not created!'], 500);
    }

    public function createPermissions(String $id){
        $role = Role::where('id', $id)->first();
        $role_permissions = $role->permissions->toArray();
        $role_permissions_ids = [];
        foreach ($role_permissions as $key => $value) {
            $role_permissions_ids[] = $value['id'];
        }
        // dd($role_permissions);
        $permissions = Permission::all()->toArray();
        return view('roles.permissions', compact('role', 'role_permissions_ids', 'permissions'));
    }

    public function storePermissions(Request $request, String $id){
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found!'], 404);
        }
    
        // Decode the JSON string to an array of permission IDs
        $permissionIds = json_decode($request->permissions, true);
    
        // Find the permissions based on the IDs
        $permissions = Permission::whereIn('id', $permissionIds)->get();
    
        // Check if all requested permissions exist
        if ($permissions->count() !== count($permissionIds)) {
            return response()->json(['error' => 'One or more permissions not found!'], 404);
        }
    
        // Sync the permissions to the role
        $role->syncPermissions($permissions);
    
        return response()->json(['success' => 'Permissions assigned to role!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return response()->json(['data' => Role::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::where('id', $id)->first()->toArray();
        return view('roles.edit', compact('role'));
    }

    protected function validateEditRole(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:16'],
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validateEditRole($request->all())->validate();
        $role = Role::find($id);
        if (!$role) {
            return response()->json(['error' => 'Role not found!'], 404);
        }
        $role->name = $request->name;
        if($role->save()){
            return response()->json(['success' => 'Role updated!'], 200);
        }
        return response()->json(['error' => 'Role not updated!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id == 1){
            return response()->json(['error' => 'Internal Server error!'], 500);
        }
        $role = Role::where('id', $id)->first();
        if($role->delete()){
            return response()->json(['success' => 'Role deleted!'], 200);
        }
        return response()->json(['error' => 'Role not deleted!'], 500);
    }
}
