@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.product') }}</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="width:60px"></th>
                            <th>Наименование</th>
                            <th>Категория</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <?php 
                                    $path_img = public_path('img/products/'.$product->img);
                                    $url_img = \App\Tools::getpreview32(public_path('img/products/'.$product->img));
                                ?>
                                @if($url_img)
                                <img class="img-thumbnail" src="{{ $url_img }}" />
                                @endif
                            </td>
                            <td>{{ str_limit($product->title, 50) }} </td>
                            <td>{{ $product->category->title or "-" }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    {!! Form::open(array('route'=>['admin.product.destroy',$product->id],'method'=>'DELETE')) !!}
                                    {!! Form::hidden('title', $product->title); !!}
                                        <a href="{{url()->route('admin.product.edit', ['product'=>$product->id])}}" class="img-circle btn btn-primary"><i class="fa fa-pencil"></i></a> 
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
                            <a href="{{url()->route('admin.product.create')}}" class="btn btn-success"><i class="fa fa-plus mr-10" aria-hidden="true"></i>Добавить</a>
                        </div>
                        <div class="col-md-8">
                            <nav style="height:34px" aria-label="Page navigation" class="pull-right">
                                {!! $products->links() !!}
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