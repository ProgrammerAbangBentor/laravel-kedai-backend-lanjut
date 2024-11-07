<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(Request $request)
    {
        //get users with pagination
        $users = User::with('roles')  // Pastikan relasi roles dimuat
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('user.index', compact('users'));

    }

    //create
    public function create()
    {
        return view ('user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone'=> 'required',
            'role' => 'required|in:admin,user,staff',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->roles,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User created successfully.');

    }

    //show
    public function show($id)
    {
        return view ('pages.dashboard');

    }

    //edit
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);

        //check if password is not empty
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            //if password is empty, then use the old password
            $data['password'] = $user->password;
        }
        $user->update($data);
        $user->assignRole($request->role);
        return redirect()->route('user.index') ->with('success', 'User updated successfully');

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

}
