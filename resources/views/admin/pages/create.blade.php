@extends('layouts.admin')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.new') }}</div>
                <form action="{{ url()->route('admin.page.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="{{auth()->user()->id }}" />
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Заголовок</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('category_id')) ? 'has-error' : '' }}">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0">---</option>
                                        @foreach($categories as $select)
                                            <option {{ (old('category_id') == $select->id) ? 'selected' : '' }} value="{{$select->id}}">{{$select->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{($errors->has('text')) ? 'has-error' : '' }}">
                                    <label for="text">Текст</label>
                                    <textarea name="text" class="form-control" rows="20">{{old('text')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="navigation" value="1" {{ (old('navigation') == 1) ? 'checked' : '' }} />
                                    <label for="navigation">Вывести ссылку в панель навигации</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="main_page" value="1" {{ (old('main_page') == 1) ? 'checked' : '' }} />
                                    <label for="main_page">Вывести на главную страницу</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o mr-10" aria-hidden="true"></i>Сохранить</button>
                                <a href="{{url()->route('admin.page.index')}}" class="btn btn-default">Закрыть</a>
                            </div>
                            <div class="col-md-8"></div>
                        </div>    
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
