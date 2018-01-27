@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="show-post">
                <span><i class="fa fa-calendar-check-o mr-10" aria-hidden="true"></i>{{ date('d.m.Y', strtotime($article->created_at)) }}</span>
                <h1><i class="fa fa-newspaper-o mr-10" aria-hidden="true"></i>{{ $article->title }}</h1>
                <p>{!! $article->text !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection