@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Task</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Title</th>
                            <th>Body</th>
                            <th></th>
                        </tr>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ link_to_route('task.show', $task->title, [$task->id]) }}</td>
                            <td>{{ $task->body }}</td>
                            <td>
                                <div class="pull-right">
                                    
                                    {!! Form::open(array('route'=>['task.destroy',$task->id],'method'=>'DELETE')) !!}
                                        <a href="{{url()->route('task.edit', ['task'=>$task->id])}}" class="btn btn-primary"><i class="fa fa-pencil-square"></i></a> 
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach    
                    </table>
                    <a href="{{url()->route('task.create')}}" class="btn btn-success">Добавить</a>
                </div>
                                    
       
            </div>
            
        </div>
    </div>
</div>
@endsection
