@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $page->title }}</div>
                <div class="panel-body">
                    <p>{{ $page->title }}</p>
                    <p>{{ $page->text }}</p>
                    <p>{{ $page->category_id }}</p>
                </div>
            </div>
            
        </div> 
    </div>
</div>
@endsection
