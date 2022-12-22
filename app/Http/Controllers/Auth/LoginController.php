<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

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
        $request->validate([
            'email'=>'required',
            'password'=> 'required',
        ]);

        $type = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)? 'email':'username';

        $guard= Auth::guard()->attempt(array($type=>$request->get('email'),'password'=>$request->get('password')),$request->boolean('remember'));
        if ($guard){
            if (Auth::user()->level_user === 'master_admin'){
                return redirect()->route('dashboardSchool');
            }
            else if (Auth::user()->level_user === 'school_admin'){
                return redirect()->route('requestSchool');
            }
            else if (Auth::user()->level_user === 'volunteer'){
                return redirect()->route('dashboardVolunteer');
            }
        }
        else{
            return redirect()->back()->withErrors(['msg' => 'Account not exist / password is wrong']);;
        }
    }
}
