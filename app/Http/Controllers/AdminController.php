<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index',['admins'=> User::where('isadmin',1)->get()]);
    }    
    public function create()
    {
        return view('admin.create');
    }                   
    public function store(Request $request)
    {
        // Validate and store the data
        $validated=$request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $validated['password'] = bcrypt("password");
        $validated['isadmin'] = 1;
        User::create($validated);
        return redirect('/admin/admin/index')->with('success', 'Admin created successfully.');
    }   

    public function edit(User $admin)
    { 
        return view('admin.edit', ['admin'=>$admin]);
    } 
    public function update(User $admin, Request $request)
    {
        // Validate and update the data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        User::update($validated);
        return redirect('admin.index');
    }
  
    public function destroy(User $user)
    {
        // Validate and delete the data
        $user->delete();
        return redirect("/admin/admin/index")->with('success', 'Admin deleted successfully.');
    }
  
}
