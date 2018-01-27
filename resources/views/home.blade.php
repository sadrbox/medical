@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        @if(isset($main_article))
        <div class="col-md-6">
            <h1>{{ $main_article->title }}</h1>
            <div class="home-post-text">{!! $main_article->text !!}</div>
        </div>
        @endif
        <div class="col-md-6">
            @foreach($articles as $article)
            <div class="list-posts">
                <b><i class="fa fa-newspaper-o mr-10" aria-hidden="true"></i>{{ link_to_route('site.article.show', str_limit($article->title, 100), [$article->id]) }}</b>
                <div>
                    {{ str_limit(strip_tags($article->text), 100) }}
                    <p><i class="fa fa-calendar-check-o mr-10" aria-hidden="true"></i>{{ date('d.m.Y', strtotime($article->created_at)) }}</p>
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    @if(isset($main_page))
    <div class="row">
        <br>
        <br>
        <div class="col-md-12">
            <h1>{{ $main_page->title }}</h1>
            <div class="home-post-text">{!! $main_page->text !!}</div>    
                      
        </div>
    </div>
    <hr>
    @endif
</div>
@endsection
