<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show register form :
    public function create(){
        return view("users.register"); 
    }
    //Create new user:
    public function store(Request $request){
        $formFileds = $request->validate([
            'name' => ['required' ,'min:3'], 
            'email' => ['required' ,'email' , Rule::unique('users','email')],
            'password' => ['required','confirmed','min:6']
        ]);
        //hash password : 
        $formFileds['password'] = bcrypt($formFileds['password']) ; 

        //create user : 
        $user = User::create($formFileds); 
        //login 
        auth()->login($user) ;
        //redirect : 
        return redirect('/')->with('message' , 'User created and loged in');    
    } 
    //logout :
    public function logout(Request $request){
        auth()->logout() ; 
        $request->session()->invalidate() ; 
        $request->session()->regenerateToken(); 
        return redirect('/')->with('message','You have been Logged out!') ; 
    }
    // show login form
    public function login(){
        return view('users.login'); 
    }
    //Login : 
    public function authenticate(Request $request){
        $formFileds = $request->validate([
            'email' => ['required', 'email'] ,
            'password' =>'required'
        ]) ; 
        if(auth()->attempt($formFileds)){
            $request->session()->regenerate(); 
            return redirect('/')->with('message' , 'You are Now loged in');
        }
        else {
            return back()->withErrors(['email' , 'invalid Credentials'])->onlyInput('email') ;
        }
    }
}
