<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'username' => ['required', 'string', 'max:12', 'min:4'],
          'mail' => ['required', 'string', 'min:4', 'email', 'unique:users'],
          'password' => ['required', 'string', 'min:4', 'max:12', 'regex:/^[a-zA-Z0-9]+$/', 'unique:users', 'confirmed'],

        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function registerForm(){
        return view("auth.register");
    }


    public function store(Request $request)
    {
      $rules = [
        'username' => 'required|string|max:12',
        'mail' => 'required|string|min:4|email|unique:dawnSNS.users,mail',
        'password' => 'required|string|min:4|max:12|regex:/^[a-zA-Z0-9]+$/|confirmed',
        'password_confirmation' => 'required',
      ];

      $this->validate($request, $rules);

        if($request->isMethod('post')){
            $data = $request->input();

            $this->create($data);
            return redirect('added');
        }
        return view('auth.register');
    }



    public function added(){
        return view('auth.added');
    }

    public function addedUser(){
      $list = \DB::connection('dawnSNS')->table('users')->orderBy('id', 'desc')->first();
      return view('auth.added', ['list' => $list]);
    }




}
