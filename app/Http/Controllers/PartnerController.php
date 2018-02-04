<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PartnerRequest;
use App\Partner;

class PartnerController extends Controller
{

    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
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
        $this->Breadcrumbs(trans('app.partner'), 'admin.partner.index');
        $this->Breadcrumbs(trans('app.edit'));
        return view('admin.partners.edit', compact('partner'));
    }    
    
    public function edit(Partner $partner)
    {
        $this->Breadcrumbs(trans('app.partner'), 'admin.partner.index');
        $this->Breadcrumbs(trans('app.edit'));
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner)
    {
        $partner->update($request->all());
        return redirect()->route('admin.partner.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partner.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }
}
