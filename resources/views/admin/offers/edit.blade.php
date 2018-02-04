@extends('layouts.admin')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.edit') }}</div>
                <form action="{{ url()->route('admin.offer.update', ['offer'=>$offer->id]) }}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Заголовок</label>
                                    <input type="text" name="title" class="form-control" value="{{$offer->title}}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{($errors->has('text')) ? 'has-error' : '' }}">
                                    <label for="text">Текст</label>
                                    <textarea name="text" class="form-control" rows="20">{{$offer->text}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o mr-10" aria-hidden="true"></i>Сохранить</button>
                                <a href="{{url()->route('admin.offer.index')}}" class="btn btn-default">Закрыть</a>
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
