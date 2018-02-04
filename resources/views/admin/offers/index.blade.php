@extends('layouts.admin')

@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.offer') }}</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Заголовок</th>
                            <th>Текст</th>
                            <th></th>
                        </tr>
                        @foreach($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>{{ str_limit(strip_tags($offer->text), 300) }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    {!! Form::open(array('route'=>['admin.offer.destroy',$offer->id],'method'=>'DELETE')) !!}
                                    {!! Form::hidden('title', $offer->title); !!}
                                        <a href="{{url()->route('admin.offer.edit', ['offer'=>$offer->id])}}" class="img-circle btn btn-primary"><i class="fa fa-pencil"></i></a> 
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
                        <div class="col-md-4">
                            <a href="{{url()->route('admin.offer.create')}}" class="btn btn-success"><i class="fa fa-plus mr-10" aria-hidden="true"></i>Добавить</a>
                        </div>
                        <div class="col-md-8">
                            <nav style="height:34px" aria-label="Page navigation" class="pull-right"></nav>
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
    $(".delete_link").on('click', function(event){
        event.preventDefault();
        var $form = $(this).parent("form");
        var $value = $form.children("[name=title]").val();
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
                    keys: ['esc'],
                },
            }
        });  
    });
});
</script>
@endsection