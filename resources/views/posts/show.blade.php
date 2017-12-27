@extends('layouts.layout') @section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="post">
                <h2>{{$post->title}}</h2>
                <p>January 1, 2014 by <a href="#">Mark</a></p>
                <p>{{$post->text}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
