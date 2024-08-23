<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\DvUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\DVUserRole;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }


public function storeUser(Request $request)
{
    // Validate form data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|unique:wp_users,user_login|max:255',
        'password' => 'required|confirmed|min:6',
        'email' => 'required|email|unique:wp_users,user_email',
       'roles' => 'required|array',
            'roles.*' => 'exists:dv_users_roles,id', // Validate that each role ex
    ]);

    // Insert into wp_users table
    $wpUserId = DB::table('wp_users')->insertGetId([
        'user_login' => $validated['username'],
        'user_pass' => Hash::make($validated['password']),
        'user_email' => $validated['email'],
       
    ]);

 
      // Create the user
      $user = DvUser::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'is_active' => $request->has('is_active'),
        'wp_users_ID' => $wpUserId,
    ]);


    $user->roles()->sync($request->roles);

    return redirect()->route('listUsers')->with('success', 'User created successfully.');
}

public function listUsers()
{
   

    // Fetch users with all their roles, including deleted roles
    $users = DvUser::with(['roles' => function ($query) {
        $query->withoutGlobalScope('not_deleted'); // Ensure all roles are fetched, including deleted ones
    }])->get();
    return view('admin.index-users', compact('users'));
}

public function createUser()
{
    $roles = DVUserRole::where('is_active', 1)->get();
    return view('admin.create-user', compact('roles')); 
}

public function editUser($id)
{
    $user = DvUser::findOrFail($id);
    $roles = DVUserRole::withoutGlobalScope('not_deleted')->get();

    return view('admin.edit-user', compact('user', 'roles'));
}

public function updateUser(Request $request, $id)
{
    $user = DvUser::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|max:255',
        'username' => 'required|unique:dv_users,username,' . $user->id,
        'email' => 'required|email|unique:dv_users,email,' . $user->id,
        'password' => 'nullable|confirmed|min:6' ,
     
    ]);

    $user->name = $validated['name'];
    $user->username = $validated['username'];
    $user->email = $validated['email'];

    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->is_active = $request->has('is_active') ? 1 : 0;

    $user->roles()->sync($request->input('roles', []));

    $user->save();
    return redirect()->route('listUsers')->with('success', __('messages.user_updated_success'));

}


public function destroyUser($id)
{
    // Find the user by ID
    $user = DvUser::findOrFail($id);

    // Delete the user
    $user->delete();

    // Redirect to the listUsers route with a success message
    return redirect()->route('listUsers')->with('success', __('messages.user_deleted_success'));
}


}
