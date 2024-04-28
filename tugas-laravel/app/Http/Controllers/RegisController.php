<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;

class RegisController extends Controller
{
    public function index(){
        return view('regis');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'username' => ['required', 'min:5', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
