@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="show-post">
                <h1>{{ $page->title }}</h1>
                <p>{!! $page->text !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
