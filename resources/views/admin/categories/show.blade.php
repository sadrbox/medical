@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $category->title }}</div>
                <div class="panel-body">
                    <p>{{ $category->title }}</p>
                    <p>{{ $category->getParent->title or "-" }}</p>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection
