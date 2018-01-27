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
                <div class="panel-heading">Task</div>

                <div class="panel-body">
                {!! Form::open(['route'=>'task.store']) !!}    
                    
                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                        </div>
                        
                    
                    {!! Form::button('Сохранить', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection
