@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Новости</div>
                <div class="panel-body">
                    <table class="table"> 
                        <tr>
                            <th>Создан</th>
                            <th>Заголовок</th>
                            <th></th>
                        </tr>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ date('d.m.Y', strtotime($article->created_at)) }}</td>
                            <td>{{ str_limit($article->title, 40) }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    <a href="{{url()->route('admin.article.edit', ['article'=>$article->id])}}" class="img-circle btn btn-primary"><i class="fa fa-pencil"></i></a> 
                                </div>
                            </td>
                        </tr>
                        @endforeach    
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{url()->route('admin.article.create')}}" class="btn btn-success"><i class="fa fa-plus mr-10" aria-hidden="true"></i>Добавить</a>
                        </div>
                    </div>    
                </div>                   
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Звонки</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="width:60px"></th>
                            <th>Имя</th>
                            <th>Телефон</th>
                        </tr>
                        @foreach($calls as $call)
                        <tr>
                            <td>
                                <input class="done" type="checkbox" style="height:30px;width:30px;"  link="{{url()->route('admin.call.done', ['call'=>$call->id])}}" {{ ($call->done == true) ? 'checked' : '' }} />
                            </td>
                            <td>{{ $call->name }}</td>
                            <td>{{ $call->phone }}</td>
                        </tr>
                        @endforeach    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(function(){
    $(".done").on('change', function(event){
        event.preventDefault();
        var $check = $(this);
        var link = $check.attr('link');
        $('[type=checkbox]').attr('disabled','disabled');
        window.location.href = link;
    });
});
</script>
@endsection