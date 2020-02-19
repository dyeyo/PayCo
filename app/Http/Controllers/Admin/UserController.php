<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
       
        $user = User::select('id', 'name', 'email')
                        ->orderBy('id', 'asc')
                        ->get();

        return response()->json(['users' => $user]);
        
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //return response()->json();

    }

    public function update(Request $request, $id)
    {
        $user= User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }

    public function destroy(Request $request, $id)
    {   
        $user = User::findOrFail($id);
        $user->delete();
        
        if($request->ajax())
        {
            return response()->json($user);
        }
            
    }

}
