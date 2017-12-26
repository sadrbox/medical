@extends('layouts.layout') @section('content')
<div class="container">
    <h2>Index page</h2>
    <br>
    <div class="row">
        @foreach($posts as $post)

        <div class="col-md-4">
            <h2>{{$post->title}}</h2>
            <p>{{$post->preview}}</p>
            <p><a href="/posts/{{$post->id}}" class="btn btn-secondary">Читать далее...</a></p>
        </div>

        @endforeach
    </div>
</div>
@endsection
