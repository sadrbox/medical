@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row"> 
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <table class="list-products">
                        @foreach($products as $product)
                        <tr>
                            <td style="width:130px;vertical-align:top">
                                <?php 
                                    $path_img = public_path('img/products/'.$product->img);
                                    $url_img = \App\Tools::getpreview128(public_path('img/products/'.$product->img));
                                ?>
                                @if($url_img)
                                <img class="img-thumbnail" src="{{ $url_img }}" />
                                @endif
                            </td>
                            <td>
                                <b>{{ link_to_route('site.product.show', str_limit($product->title, 300), [$product->id]) }}</b>
                                <div>{{ str_limit(strip_tags($product->description), 300) }}</div>
                                <div style="border-top:1px dotted #CCC;margin:10px 0">
                                    Цена: {{ $product->price }} 
                                    @if(Auth::guard('admin')->check())
                                        {{ '| Цена партнера: '.$product->price_partner }}
                                    @elseif(Auth::guard('partner')->check())
                                        {!! auth()->guard('partner')->user()->verified_partner ? '| Цена партнера: '.$product->price_partner  : '| <a href="/site/formcallme">Получить уникальную цену</a>' !!}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </table>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-posts-category">
            @foreach($categories as $category)
                @if($category->products->count() > 0)
                <p>
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <a href="{{ url()->route('site.product', ['category'=>$category->id]) }}">{{ str_limit($category->title, 100) }} <span class="badge">{{ $category->products->count() }}</span></a>
                </p>
                @endif
            @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <nav aria-label="Page navigation" class="pull-right">
                {!! $products->links() !!}
            </nav>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
@endsection