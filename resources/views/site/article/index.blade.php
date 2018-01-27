@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach($articles as $article)
            <div class="list-posts">
                <b><i class="fa fa-newspaper-o mr-10" aria-hidden="true"></i>{{ link_to_route('site.article.show', str_limit($article->title, 100), [$article->id]) }}</b>
                <div>
                    {{ str_limit(strip_tags($article->text), 400) }}
                    <p><i class="fa fa-calendar-check-o mr-10" aria-hidden="true"></i>{{ date('d.m.Y', strtotime($article->created_at)) }}</p>
                </div>
            </div>
            <hr>
            @endforeach 
        </div>
        <div class="col-md-4">
            <div class="list-posts-category">
            @foreach($categories as $category)
                @if($category->articles->count() > 0)
                <p>
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <a href="{{ url()->route('site.article', ['category'=>$category->id]) }}">{{ str_limit($category->title, 100) }} <span class="badge">{{ $category->articles->count() }}</span></a>
                </p>
                @endif
            @endforeach 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="Page navigation" class="pull-right">
                {!! $articles->links() !!}
            </nav>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection