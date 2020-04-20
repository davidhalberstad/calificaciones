<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Project;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();        
        return view('admin.users.index')->with(compact('users'));
    }

    public function store(Request $request)
    {
        $rules = [
            // 'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6|confirmed'
        ];

        $messages = [
            // 'name.required' => 'Es necesario ingresar un nombre de Usuario.',
            // 'email' => 'Es necesario ingresar un E-mail',
            // 'password' => 'Es nesario ingresar una Clave'
        ];
        
        $this->validate($request, $rules, $messages);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 1;

        $user->save();

        // dd($request->all());

        return back()->with('notification', 'Usuario Registrado Exitosamente!!!');
    }

    public function edit($id)
    {
        $user = User::find($id); 
        $projects = Project::all(); 
        return view('admin.users.edit')->with(compact('user', 'projects'));
    }

    public function update($id, Request $request)
    {
               
        $rules = [
            // 'name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6|confirmed'
        ];

        $messages = [
            // 'name.required' => 'Es necesario ingresar un nombre de Usuario.',
            // 'email' => 'Es necesario ingresar un E-mail',
            // 'password' => 'Es nesario ingresar una Clave'
        ];
        
        $this->validate($request, $rules, $messages);
        
        $user = User::find($id);
        $user->name = $request->input('name');
                
        $password = $request->input('password');
        if ($password)
        $user->password = bcrypt($password);

        $user->save();

        return back()->with('notification', 'Usuario Registrado Exitosamente!!!');
    }

    public function delete($id)
    {
        $user = User::find($id); 
        $user->delete(); 

        return back()->with('notification', 'El Usuario se ha dado de baja correctamente!!!');
    }

}
