<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('view permissions')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        return view('permissions.view');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create permissions')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        return view('permissions.create');
    }

    protected function validateCreatePermission(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'unique:permissions', 'max:32'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('create permissions')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $this->validateCreatePermission($request->all())->validate();
        $permission = Permission::create(['name' => $request->name]);
        if($permission){
            return response()->json(['success' => 'Permission created!'], 200);
        }
        return response()->json(['error' => 'Permission not created!'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (!auth()->user()->can('view permissions')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        return response()->json(['data' => Permission::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->user()->can('edit permissions')) {
            abort(403, 'Unauthorized action. You do not have the required permission.');
        }
        $permission = Permission::where('id', $id)->first()->toArray();
        return view('permissions.edit', compact('permission'));
    }

    protected function validateEditPermission(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:32'],
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->can('edit permissions')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $this->validateEditPermission($request->all())->validate();
        $permission = Permission::find($id);
        if (!$permission) {
            return response()->json(['error' => 'Permission not found!'], 404);
        }
        $permission->name = $request->name;
        if($permission->save()){
            return response()->json(['success' => 'Permission updated!'], 200);
        }
        return response()->json(['error' => 'Permission not updated!'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->can('delete permissions')) {
            return response()->json(['data' => 'Unauthorized action. You do not have the required permission.'], 403);
        }
        $permission = Permission::where('id', $id)->first();
        if($permission->delete()){
            return response()->json(['success' => 'Permission deleted!'], 200);
        }
        return response()->json(['error' => 'Permission not deleted!'], 500);
    }
}
