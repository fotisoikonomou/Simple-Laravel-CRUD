<?php

namespace App\Http\Controllers;
use App\Models\DVUserRole;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $roles = DVUserRole::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:dv_users_roles,name',
        ]);

        DVUserRole::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);

      

        return redirect()->route('admin.roles.index')->with('success', __('messages.roles_deleted_success'));
    }

    public function edit(DVUserRole $role)
{
    return view('admin.roles.edit', compact('role'));
}

public function update(Request $request, DVUserRole $role)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:dv_users_roles,name,' . $role->id,
    ]);

    $role->update([
        'name' => $request->name,
        'is_active' => $request->has('is_active') ? 1 : 0,
    ]);

    return redirect()->route('admin.roles.index')->with('success', __('messages.role_updated_success'));

    
}

public function destroyRole($id)
{
    // Find the user by ID
    $role = DVUserRole::findOrFail($id);

    $role->is_deleted = true;
    $role->save();

 

    return redirect()->route('listUsers')->with('success', __('messages.role_deleted_success'));
}
}