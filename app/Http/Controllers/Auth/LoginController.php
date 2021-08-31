<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    // use AuthenticatesUsers {
    //   logout as performLogout;
    // }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    // protected function loggetOut(Ruquest $request)
    // {
    //   return redirect(route('auth.login'));
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        if($request->isMethod('post')){
          $rules = [
            'mail' => 'required|exists:dawnSNS.users',
            'password' => 'required|min:4|max:12|alpha_num',
          ];

          $this->validate($request, $rules);


            $data=$request->only('mail','password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login");
    }

    public function logout(Request $request)
    {
      Auth::logout();
      return redirect('/login');
    }

    private const GUEST_USER_ID = 7;

    public function guestLogin()
    {
       // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
       if (Auth::loginUsingId(self::GUEST_USER_ID)) {
        return redirect('/top');
      }

    return redirect('/top');
    }


}
