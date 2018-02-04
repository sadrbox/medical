<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OfferRequest;
use App\Offer;

class OfferController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
    }
    
    public function index()
    {   
        $this->Breadcrumbs(trans('app.offer'), 'admin.offer.index');
        $offers = Offer::all();
        return view('admin.offers.index', compact('offers'));
    }

    public function create()
    {
        $this->Breadcrumbs(trans('app.offer'), 'admin.offer.index');
        $this->Breadcrumbs(trans('app.new'));
        $offers = Offer::all();
        return view('admin.offers.create', compact('offers'));
    }

    public function store(OfferRequest $request)
    {
        Offer::create($request->all());
        return redirect()->route('admin.offer.index')->with('message', 'Новая запись сохранена!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Offer $offer)
    {
        $this->Breadcrumbs(trans('app.offer'), 'admin.offer.index');
        $this->Breadcrumbs(trans('app.edit'));
        return view('admin.offers.edit', compact('offer'));
    }

    public function update(OfferRequest $request, Offer $offer)
    {
        $offer->update($request->all());
        return redirect()->route('admin.offer.index')->with('message', 'Изменения сохранены!');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('admin.offer.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }
}
