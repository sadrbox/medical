<?php

namespace App\Http\Controllers\Auth\Admin;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $guard = 'admin';
    protected $redirectTo = '/admin';
    protected $username = 'username';
    
    public $loginView = 'auth.admin.login';
    public $registerView = 'auth.admin.register';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    
    // public function showResetForm(Request $request, $token = null)
    // {
    //     return view('auth.admin.passwords.reset')->with(
    //         ['token' => $token, 'email' => $request->email]
    //     );
    // }
}
