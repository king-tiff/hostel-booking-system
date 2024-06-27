<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\Rules; 
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Role;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_count = [];
        $users = User::with('roles')->get();
        $roles = Role::all();

        foreach ($roles as $role) {
            $user_count[$role->name] = User::role($role->name)->count();
        }

        return Inertia::render('Admin/UserManagement', [
            'user_count' => $user_count,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AddUser');
            }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $user->assignRole($formFields['role']);
    
        event(new Registered($user));
    
        return redirect()->route('admin.users.index')->with('flash', 'User created successfully.');
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
    public function edit(User $user)
    {
        $user = User::with('roles')->find($user->id);
        return Inertia::render('Admin/EditUser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|string',
        ]);

        // Remove old role first if it exists
        $user->removeRole($user->roles->first()->name);

        $user->update($request->all());
        $user->assignRole($formFields['role']);

        return redirect()->route('admin.users.index', $user)->with('flash', 'User updated successfully.');
    }

    public function resetPassword(User $user)
    {
        $user->update([
            'password' => Hash::make('12345678'),
        ]);

        return redirect()->route('admin.users.index')->with('flash', 'User password reseted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('flash', 'User deleted successfully.');
    }
}
