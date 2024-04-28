<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($username)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('editProfile', [
            'user' =>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $rules = [
            'password' => 'required|min:5|max:255'
        ];
        if($request->username != $user->username){
            $rules['username'] = ['required', 'min:5', 'max:255', 'unique:users'];
        }
        if($request->email != $user->email){
            $rules['email'] = 'required|email:dns|unique:users';
        }
        $validatedData = $request->validate($rules);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::where('id', $user->id)->update($validatedData);

        return redirect('/profile')->with('success', 'Profile berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $user->questions()->delete();
        $user->answers()->delete();
        $user->comments()->delete();
        $user->delete();
    
        return redirect('/register')->with('success', 'Akun berhasil dihapus!');
    }
}
