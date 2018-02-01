<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Partner;

class PartnerController extends Controller
{

    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'));
    }
    
    public function index()
    {        
        $this->Breadcrumbs(trans('app.partner'), 'admin.partner.index');
        $partners = Partner::paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function partnership(Partner $partner)
    {
        if($partner->verified_partner == false){ $partner->verified_partner = true; }
        else{ $partner->verified_partner = false; }
        $partner->save();
        return back();
    }
    
    public function profile(Partner $partner)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
