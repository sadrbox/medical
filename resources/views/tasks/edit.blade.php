@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if($errors->has())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Task edit</div>

                <div class="panel-body">
                {!! Form::model($task, ['route'=>['task.update', $task->id], 'method'=>'PUT']) !!}    
                    
                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                        </div>
                        
                    
                    {!! Form::button('Сохранить', ['type'=>'submit', 'class'=>'btn btn-primary dib']) !!}
                    <a href="{{url()->route('task.index')}}" class="btn btn-default dib">Закрыть</a> 
                {!! Form::close() !!}
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection
