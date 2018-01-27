<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    public function Breadcrumbs($name, $route = null, $arg = null){
        \Session::push('breadcrumbs', ['name'=>$name, 'route'=>$route, 'arg'=>$arg]);
        $breadcrumbs = \Session::get('breadcrumbs');
        return $breadcrumbs;
    }
}
