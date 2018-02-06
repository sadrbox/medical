@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row"> 
        <div class="col-md-4">
            <ul class="menu-list">
                @foreach($categories as $category)
                <li class="menu-item">
                    <a href="{{ url()->route('site.product', ['category'=>$category->id]) }}">{{ str_limit($category->title, 100) }} <!-- <span class="badge">{{ $category->products->count() }}</span> --></a>
                    @if(\App\Category::find($category->id)->childs()->count() > 0)
                        <ul class="menu-list-inner">
                        @foreach(\App\Category::find($category->id)->childs()->get() as $child)
                            <li class="menu-item">
                                <a href="{{ url()->route('site.product', ['category'=>$child->id]) }}">{{ str_limit($child->title, 100) }} <!-- <span class="badge">{{ $child->products->count() }}</span> --></a>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
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

@section('script')
<script>
// $(function(){
//     $(".menu-item-inner").hover(
//         function () {
//             var $inner = $(this);
//             $inner.children(".menu-list-inner").show();
            
//         },
//         function () {
//             var $inner = $(this);
//             $inner.children(".menu-list-inner").hide();
            
//         }
//     );
// });
</script>
@endsection