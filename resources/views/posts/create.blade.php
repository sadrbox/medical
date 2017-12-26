@extends('layouts.layout') @section('content')
<div class="container">
    <form>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" />
        </div>
        <div class="form-group">
            <label for="preview">Preview</label>
            <input type="text" name="preview" id="preview" />
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea type="text" name="text" id="text"></textarea>
        </div>
    </form>

</div>
@endsection
