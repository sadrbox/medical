@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.new') }}</div>
                <form action="{{ url()->route('admin.category.store') }}" method="POST">
                {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Наименование</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('parent_id')) ? 'has-error' : '' }}">
                                    <label for="parent_id">Группа</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">---</option>
                                        @foreach($categories as $select)
                                            <option {{ (old('parent_id') == $select->id) ? 'selected' : '' }} value="{{$select->id}}">{{$select->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o mr-10" aria-hidden="true"></i>Сохранить</button>
                                <a href="{{url()->route('admin.category.index')}}" class="btn btn-default">Закрыть</a>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>    
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
