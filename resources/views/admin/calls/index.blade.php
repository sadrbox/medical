@extends('layouts.admin')

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.call') }}</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="width:60px"></th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th></th>
                        </tr>
                        @foreach($calls as $call)
                        <tr>
                            <td>
                                <input disabled="disabled" class="done" type="checkbox" style="height:30px;width:30px;"  link="{{url()->route('admin.call.done', ['call'=>$call->id])}}" {{ ($call->done == true) ? 'checked' : '' }} />
                            </td>
                            <td>{{ $call->name }}</td>
                            <td>{{ $call->phone }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    {!! Form::open(array('route'=>['admin.call.destroy',$call->id],'method'=>'DELETE')) !!}
                                    {!! Form::hidden('phone', $call->phone); !!}
                                        <a class="delete_link btn btn-danger"><i class="fa fa-trash"></i></a>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach    
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <nav style="height:34px" aria-label="Page navigation" class="pull-right">
                                {!! $calls->links() !!}
                            </nav>
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
    $(".done").on('change', function(event){
        event.preventDefault();
        var $check = $(this);
        var link = $check.attr('link');
        $('[type=checkbox]').attr('disabled','disabled');
        window.location.href = link;
    });
    $(".delete_link").on('click', function(event){
        event.preventDefault();
        var $form = $(this).parent("form");
        var $value = $form.children("[name=phone]").val();
        // alert($value);
        $.confirm({
            title: 'Предупреждение',
            content: 'Удалить элемент - '+$value+' ?',
            theme: 'dark',
            buttons: {
                yes: {
                    text: 'Удалить',
                    btnClass: 'btn-red',
                    keys: ['enter'],
                    action: function(){
                        $form.submit();
                    }
                },
                no: {
                    text: 'Отмена',
                    // btnClass: 'btn-dark',
                    keys: ['esc'],
                    action: function(){
                        // return false;
                    }
                },
            }
        });  
    });
});
</script>
@endsection