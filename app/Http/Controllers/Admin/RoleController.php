<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Add role middleware if needed
        // $this->middleware('role:admin');
    }
    
    public function index()
    {
        $roles = Role::withCount(['users', 'permissions'])->get();
        return view('admin.roles.index', compact('roles'));
    }
    
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'permissions' => ['nullable', 'array'],
        ]);
        
        $role = Role::create([
            'name' => strtolower($request->name),
        ]);
        
        if ($request->has('permissions')) {
            $role->permissions()->attach($request->permissions);
        }
        
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }
    
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }
    
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'permissions' => ['nullable', 'array'],
        ]);
        
        // Don't allow changing the name of core roles
        if (!in_array($role->name, ['admin', 'manager', 'customer'])) {
            $role->name = strtolower($request->name);
            $role->save();
        }
        
        // Sync permissions
        $role->permissions()->sync($request->permissions ?? []);
        
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully.');
    }
    
    public function destroy(Role $role)
    {
        // Prevent deleting core roles
        if (in_array($role->name, ['admin', 'manager', 'customer'])) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Cannot delete core roles.');
        }
        
        // Detach all users and permissions
        $role->users()->detach();
        $role->permissions()->detach();
        $role->delete();
        
        return redirect()->route('admin.roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}