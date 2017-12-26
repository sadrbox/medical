@extends('layouts.layout') @section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">{{$post->title}}</h2>
                <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

                <p>{{$post->text}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
