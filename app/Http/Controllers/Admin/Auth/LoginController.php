<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return  view('admin.login');
    }

    public function login(Request $request){
        $creds = $request->only(['email','password']);

        $rules = [
            ['email' => 'string|max:155|unique'],
            ['password' => 'string|max:155,|min:5']
        ];

        $validator = Validator::make($creds,$rules);

        $remember = $request->input('remember',false);

        if($validator->fails()){
            return redirect()->route('painel.login')
            ->withErrors($validator)
            ->withInput();
        }else{
            return Auth::attempt($creds,$remember) ? redirect()->route('painel'): redirect()->route('painel.login')
            ->with('warning','E-mail e/ou Senha inválidos');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('painel');
    }
}
