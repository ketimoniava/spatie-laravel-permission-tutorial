<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class SessionsController extends Controller
{
	public function __construct(){
		//$this->middleware('guest', ['except'=>'destroy']);
		$this->middleware('guest')->except('destroy');
	}

    public function create(){
    	return view('sessions.create');
    }

    public function store(){
    	//attempt to authentication the user
        //echo "$_POST["email"];"
    	if (! auth()->attempt(request(['email','password']))){
    		return back()->withErrors([
    			'message' => 'Please check your credentials and try again.'
    		]);
    	}

       	//If not redirect back

    	return redirect('/');

    	//If so, sign then in

    	//Redirect to the home page.
    }

    public function destroy() {
    	auth()->logout();
    	return redirect('/');//->home();
    }
}
