@extends('layouts.layout') @section('content')
<div class="container">
    <h2>Edit post</h2>
    <form action="/post/{{$post->alias}}" method="post">
        {{csrf_field()}} 
        {!! method_field('patch') !!}
        
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{$post->title}}" />
        </div>
        <div class="form-group">
            <label for="alias">Alias</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="alias" id="alias" value="{{$post->alias}}"  />
        </div>
        <div class="form-group">
            <label for="preview">Preview</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="preview" id="preview" value="{{$post->preview}}"  />
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="text" id="text">{{$post->text}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
    
    @include('layouts.error')

</div>
@endsection