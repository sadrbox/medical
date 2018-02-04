@extends('layouts.admin')

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
                                <input disabled="disabled" class="done" type="checkbox" style="height:30px;width:30px;"  link="{{url()->route('admin.call.done', ['call'=>$call->id])}}" {{ ($call->done == true) ? 'checked' : '' }} />
                            </td>
                            <td>{{ $call->name }}</td>
                            <td>{{ $call->phone }}</td>
                        </tr>
                        @endforeach    
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Партнеры</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="width:60px">Статус</th>
                            <th></th>
                            <th>Nickname</th>
                            <th>{{ trans('app.email') }}</th>
                            <th>{{ trans('app.phone') }}</th>
                        </tr>
                        @foreach($partners as $partner)
                        <tr>
                            <td>
                                <input disabled="disabled" class="done" type="checkbox" style="height:30px;width:30px;"  link="{{url()->route('admin.partner.partnership', ['partner'=>$partner->id])}}" {{ ($partner->verified_partner == true) ? 'checked' : '' }} />
                            </td>
                            <td><img class="avatar32" src="{{ $partner->photo }}" /></td>
                            <td><a href="{{url()->route('admin.partner.edit', ['partner'=>$partner->id])}}">{{ $partner->username }}</a></td>
                            <td>{{ $partner->email }}</td>
                            <td>{{ $partner->phone }}</td>
                        </tr>
                        @endforeach    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .table td{
        vertical-align:middle !important;
    }
</style>
@endsection

@section('script')
<script>
$(function(){
    $('[type=checkbox]').removeAttr('disabled');
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