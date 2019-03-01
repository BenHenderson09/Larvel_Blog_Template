<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts;
        return view('pages.user.index', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('pages.user.edit');        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Basic validation (doesn't cater for unique)
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255']
        ]);

        $user = auth()->user();

        // If the username has been changed
        if ($user->username != $request->input('username')){
            
            // If a user with that username already exists 
            if (User::where('username', $request->input('username'))->exists()){
                return redirect()->back()->with('error', 'Username already taken');
            }
        }

        // If the email has been changed
        if ($user->email != $request->input('email')){
            
            // If a user with that email already exists 
            if (User::where('email', $request->input('email'))->exists()){
                return redirect()->back()->with('error', 'Email already taken');
            }
        }

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        return redirect('/')->with('success', 'Account Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $currentUser = auth()->user();
        $posts = $currentUser->posts;

        // Delete all posts
        foreach($posts as $post){
            $post->delete();
        }

        // Delete records of password resets
        $currentUser->removePasswordResets();

        // Delete the user
        $currentUser->delete();

        return redirect('/')->with('success', 'Account Deleted Successfully');
    }
}
