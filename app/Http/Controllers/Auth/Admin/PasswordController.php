<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{

    use ResetsPasswords;
     
    public $resetView = 'auth.admin.passwords.reset';
    public $linkRequestView = 'auth.admin.passwords.email';
    
    public function __construct()
    {
        $this->middleware('guest');
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'));
    }
}
