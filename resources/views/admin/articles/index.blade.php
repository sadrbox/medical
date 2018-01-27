@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.article') }}</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Создан</th>
                            <th>Заголовок</th>
                            {{--<th>Текст</th>--}}
                            <th>Категория</th>
                            <th>Автор</th>
                            <th></th>
                        </tr>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ date('d.m.Y', strtotime($article->created_at)) }}</td>
                            <td>{{ str_limit($article->title, 50) }} {{-- link_to_route('admin.article.show', str_limit($article->title, 50), [$article->id]) --}}</td>
                            {{--<td>{{ str_limit(strip_tags($article->text), 50) }}</td>--}}
                            <td>{{ $article->category->title or "-" }}</td>
                            <td>{{ $article->user->name or "-" }}</td>
                            <td>
                                <div class="pull-right text-nowrap">
                                    {!! Form::open(array('route'=>['admin.article.destroy',$article->id],'method'=>'DELETE')) !!}
                                    {!! Form::hidden('title', $article->title); !!}
                                        <a href="{{url()->route('admin.article.edit', ['article'=>$article->id])}}" class="img-circle btn btn-primary"><i class="fa fa-pencil"></i></a> 
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
                            <a href="{{url()->route('admin.article.create')}}" class="btn btn-success"><i class="fa fa-plus mr-10" aria-hidden="true"></i>Добавить</a>
                        </div>
                        <div class="col-md-8">
                            <nav style="height:34px" aria-label="Page navigation" class="pull-right">
                                {!! $articles->links() !!}
                            </nav>
                        </div>
                    </div>    
                </div>                   
            </div>
        </div>
    </div>
</div>
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