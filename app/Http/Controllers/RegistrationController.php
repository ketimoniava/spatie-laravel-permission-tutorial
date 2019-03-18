<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use App\Role;



class RegistrationController extends Controller
{
    public function create(){ //Register page
    	return view('registration.create');
    }

    public function store(RegistrationForm $form){ //Submit registration form
    	
      //print_r($request->input());
    	//$name = $request->input("name");
    	//$password = $request->input("password");
    	//$email = $request->input("email");

    	//'password' => Hash::make($data['password']),
    	
       $form->persist();

       // session('message','Here is a default message');

      session()->flash('message','Thanks so much for signing up!');

      return redirect('/');
    }

    
    
}
