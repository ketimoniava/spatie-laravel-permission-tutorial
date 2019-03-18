<?php

namespace App\Http\Requests;

use App\User;

use App\mail\Welcome;

use illuminate\Support\Facades\Mail;

//use Illuminate\Http\Request;

//use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm1 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->name();
        return [
            'name' => 'request',
            'email' => 'required|email',
            'password' => 'required|confirmed'
            //
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

        //Hash::make($data['password'])

        //Sign then in.
        //request()->input
        //auth()
        //Auth::login();

        auth()->login($user);

        \Mail::to($user)->send(new Welcome($user));

        //Regirect to the home page.

    }


    
}
