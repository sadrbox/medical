@extends('layouts.layout') @section('content')
<div class="container">
    <h2>Publish post</h2>
    <form action="/post" method="post">
        {{csrf_field()}} 
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="" />
        </div>
        <div class="form-group">
            <label for="alias">Alias</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="alias" id="alias" />
        </div>
        <div class="form-group">
            <label for="preview">Preview</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="preview" id="preview" />
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="text" id="text"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Post</button>
        </div>
    </form>
    
    @include('layouts.error')

</div>
@endsection
