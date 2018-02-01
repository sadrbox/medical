<?php

namespace App\Http\Controllers\Auth\Partner;

use Illuminate\Http\Request;
use App\Partner;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    
    protected $guard = 'partner';
    protected $redirectTo = '/partner';
    protected $username = 'email';
    
    public $loginView = 'auth.partner.login';
    public $registerView = 'auth.partner.register';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.partner'));
    }

    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'username' => 'required|max:255|unique:partners',
            'email' => 'required|email|max:255|unique:partners',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    { 
        return Partner::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function loginSocial(Request $request)
    {
        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $request->token . '&host=' . $_SERVER['HTTP_HOST']);
        $ulogin = json_decode($s, true);
        // $user['network'] - соц. сеть, через которую авторизовался пользователь
        // $user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
        // echo $user['first_name']; // - имя пользователя
        // echo $user['last_name']; // - фамилия пользователя
        // dd($ulogin);
        $ulogin['username'] = (isset($ulogin['nickname']) ? $ulogin['nickname'] : $ulogin['first_name']);
        
        $partner = Partner::where('uid', $ulogin['uid'])->first();
        if (isset($ulogin['uid']) && isset($partner->id)) {
            Auth::guard('partner')->loginUsingId($partner->id, TRUE);
        }
        if (isset($ulogin['uid']) && empty($partner))
        {
            $newPartner = Partner::create($ulogin);
            Auth::guard('partner')->loginUsingId($newPartner->id, TRUE);
        }
        return redirect('/');
    }
  
}
