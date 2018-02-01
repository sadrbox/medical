@extends('layouts.admin')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.profile') }}</div>
                <form action="{{ url()->route('admin.partner.update', ['partner'=>$partner->id]) }}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{($errors->has('first_name')) ? 'has-error' : '' }}">
                                    <label for="first_name">Имя</label>
                                    <input type="text" name="first_name" class="form-control" value="{{$partner->first_name}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{($errors->has('last_name')) ? 'has-error' : '' }}">
                                    <label for="last_name">Фамилия</label>
                                    <input type="text" name="last_name" class="form-control" value="{{$partner->last_name}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o mr-10" aria-hidden="true"></i>Сохранить</button>
                                <a href="{{url()->route('admin.partner.index')}}" class="btn btn-default">Закрыть</a>
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
