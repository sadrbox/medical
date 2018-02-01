@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.partner') }}</div>
                <div class="panel-body">
                    <table class="table"> 
                        <tr>
                            <th style="width:60px">Статус</th>
                            <th></th>
                            <th>email</th>
                            <th>Соцсеть</th>
                            <th>Nickname</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Создан</th>
                            <th></th>
                        </tr>
                        @foreach($partners as $partner)
                        <tr>
                            <td>
                                <input disabled="disabled" class="partnership" type="checkbox" style="height:30px;width:30px;"  link="{{url()->route('admin.partner.partnership', ['partner'=>$partner->id])}}" {{ ($partner->verified_partner == true) ? 'checked' : '' }} />
                            </td>
                            <td><img class="avatar" src="{{ $partner->photo }}" /></td>
                            <td>{{ $partner->email }}</td>
                            <td>{{ $partner->network }}</td>
                            <td>{{ $partner->username }}</td>
                            <td>{{ $partner->first_name }}</td>
                            <td>{{ $partner->phone }}</td>
                            <td>{{ date('d.m.Y', strtotime($partner->created_at)) }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    <a href="{{url()->route('admin.partner.profile', ['partner'=>$partner->id])}}" class="img-circle btn btn-primary"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a> 
                                </div>
                            </td>
                        </tr>
                        @endforeach    
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>    
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
    $(".partnership").on('change', function(event){
        event.preventDefault();
        var $check = $(this);
        var link = $check.attr('link');
        $('[type=checkbox]').attr('disabled','disabled');
        window.location.href = link;
    });
});
</script>
@endsection