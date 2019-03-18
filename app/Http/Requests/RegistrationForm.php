<?php

namespace App\Http\Requests;

use App\User;
use App\Role;

use App\Mail\Welcome;

use illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;


class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
       //$this->name();
       /* $validation =  Validator::make($request->all(), [
          'name'   => 'required',
          'email'    => 'required|email',
          'password'   => 'required|confirmed'
        ]);*/
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ];
    }

    public function persist(){
        // $user = User::create(
        //     $this->only(['name','email','password'])
        // );

        $user = User::create([
          'name' => $this->name,
          'email' => $this->email,
          'password' => bcrypt($this->password)
        ]);

        $user
           ->roles()
           ->attach(Role::where('name', 'employee')->first());

        auth()->login($user);

        \Mail::to($user)->send(new Welcome($user));

        //Regirect to the home page.

    }


    
}
