@extends('layouts.admin')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Редактирование</div>
                <form action="{{ url()->route('admin.category.update', ['category'=>$category->id]) }}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Наименование</label>
                                    <input type="text" name="title" class="form-control" value="{{$category->title}}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('parent_id')) ? 'has-error' : '' }}">
                                    <label for="parent_id">Группа</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0" selected>---</option>
                                        @foreach($categories as $select)
                                            <option <?= ($category->parent_id == $select->id) ? "selected" : "" ?> value="{{$select->id}}">{{$select->title}}</option>
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
                                <a href="{{url()->route('admin.call.index')}}" class="btn btn-default">Закрыть</a>
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
