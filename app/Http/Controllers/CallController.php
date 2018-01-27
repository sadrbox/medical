<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CallRequest;
use App\Call;


class CallController extends Controller
{
    public function __construct()
    {
        session()->forget('breadcrumbs');
        $this->Breadcrumbs(trans('app.panel'), 'admin.index');
    }
    
    public function index()
    {
        $this->Breadcrumbs(trans('app.call'), 'admin.call.index');
        $calls = Call::orderBy('done')->paginate(10);
        return view('admin.calls.index', compact('calls'));
    }

    public function done(Call $call)
    {
        if($call->done == false){ $call->done = true; }
        else{ $call->done = false; }
        $call->save();
        return back();
    }
    
    public function create(){}

    public function store(CategoryRequest $request){}

    public function show(Call $call){}

    public function edit(Call $call){}

    public function update(CallRequest $request, Call $call){}

    public function destroy(Call $call)
    {
        $call->delete();
        return redirect()->route('admin.call.index')->with(['message'=>'Удаление выполнено!', 'type'=>'success']);
    }
}
