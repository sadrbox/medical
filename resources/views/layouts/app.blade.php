<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title or "Медицинское оборудование" }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css?<?php echo time(); ?>" />
    
    <!--// owlcarousel-->
    <link rel="stylesheet" href="/extensions/owlcarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/extensions/owlcarousel/dist/assets/owl.theme.default.min.css">    
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <style>
        body {
            font:16px 'Source Sans Pro', sans-serif;
        }
    </style>
</head>
<body>
<div id="app-layout">
    <section class="header">
        <div class="bgimg">
            <div class="company"> 
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="company-name">Компания <br>«медицинское оборудование»</h2>
                            <hr class="visible-xs visible-sm" />
                        </div>
                        <div class="col-md-3">
                            <a href="{{ url()->route('site.formcallme') }}" class="btn btn-lg btn-success btn-getCall pull-right">
                                <span class="get-call">
                                    <i class="fa fa-mobile fa-2x mr-10" aria-hidden="true"></i>
                                    Мы перезвоним
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @if (request()->is('/') || request()->is('site'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="offer owl-carousel">
                            @foreach (App\Offer::all() as $offer)
                                <div>
                                    <h1 class="business-slogan">{{ $offer->title }}</h1>
                                    <p>{!! str_limit($offer->text, 300) !!}</p>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .offer .owl-stage-outer{
                        margin:50px 0 30px 0;
                        border-radius:2px;
                        background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6));
                        height:100%;
                        display: flex;
                        justify-content: center;
                        flex-direction: column;
                    }
                    .offer .owl-item div{
                        padding:30px;
                    }

                </style>
                @endif
            </div>
        </div>
    </section>
    <section class="wrap">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                     <!--Branding Image -->
                    <div class="navbar-brand">
                        <i class="fa fa-mobile fa-lg mr-10" aria-hidden="true"></i> <span>+7(707)955-55-55</span>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url()->route('site.index') }}">{{ trans('app.main') }}</a></li>
                        <li><a href="{{ url()->route('site.article') }}">{{ trans('app.article') }}</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ trans('app.product') }}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url()->route('site.product') }}">Все категории</a></li>
                                @foreach (App\Category::has('products')->get() as $navbar_product_category)
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url()->route('site.product', ['category'=>$navbar_product_category->id]) }}">{{ $navbar_product_category->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @foreach (App\Page::where('navigation', '=', 1)->get() as $navbar_page)
                            <li><a href="{{ url()->route('site.page.show', ['page'=>$navbar_page->id]) }}">{{ $navbar_page->title }}</a></li>
                        @endforeach
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::guard('admin')->check())
                        <li><a href="{{ url('/admin') }}">{{ trans('app.panel') }}</a></li>
                        <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out mr-10"></i>Выход({{ Auth::guard('admin')->user()->username }})</a></li>
                        @elseif(Auth::guard('partner')->check())
                        <li><a href="{{ url('/partner/profile') }}">{{ trans('app.profile') }}</a></li>
                        <li><a href="{{ url('/partner/logout') }}"><i class="fa fa-btn fa-sign-out mr-10"></i>Выход({{ Auth::guard('partner')->user()->username }})</a></li>
                        @else
                        <li>
                            <div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name;optional=nickname,email,bdate,sex,phone,photo,city,country;providers=vkontakte,odnoklassniki,mailru,facebook,google;hidden=twitter,yandex;redirect_uri=http%3A%2F%2Fmedical-sadrbox.c9users.io%2Fpartner%2FloginSocial;mobilebuttons=0;"></div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @include('layouts.breadcrumbs')
        @include('layouts.messages')
        @yield('content')
    </section>
    @if (request()->is('/') || request()->is('site'))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-product owl-carousel">
                @foreach (App\Product::inRandomOrder()->get() as $product)
                    <div class="card-product-container">
                        <img src="{{ \App\Tools::getpreview256(public_path('img/products/'.$product->img)) }}" />
                        <div class="border-line"></div>
                        <a href="{{ url()->route('site.product.show', ['product'=>$product->id]) }}">{{ $product->title }}</a>
                        <div class="border-line"></div>
                        <p>{!! str_limit(strip_tags($product->description), 100) !!}</p>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        .card-product .owl-stage-outer{
            margin:50px 0 30px 0;
        }
        .card-product .owl-item{
            height:100%;
            /*padding:5px;*/
        }
        .card-product-container{
            height:350px;
            margin:0 15px 0 0px;
            padding:5px;
            border:1px solid #ccc;
            border-radius:2px;
            /*box-shadow:0 0 10px 2px #000;*/
        }
        .card-product-container a, .card-product-container p{
            font-size:15px;
        }
        .card-product-container .border-line{
            border-top:1px solid #CCC;
            margin:5px 0;
        }

    </style>
    @endif
    <section class="footer">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <p>Республика Казахстан, г. Алматы, A05C9Y3 ул.Гоголя, 111, уг. ул.Наурызбай батыра</p>
                </div>
                <div class="col-md-3">
                    @if( ! Auth::guard('partner')->check() && ! Auth::guard('admin')->check())
                    <a class="pull-right" href="{{ url('/admin') }}">Администратор</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
    @yield('template')
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    <!-- google maps location -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    
    <!-- jquery-confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    
    <!-- https://owlcarousel2.github.io/OwlCarousel2/docs/started-installation.html  -->
    <script type="text/javascript" src="/extensions/owlcarousel/dist/owl.carousel.min.js"></script>
    
    <!-- wysiwyg-->
    <script src="/extensions/tinymce/tinymce.min.js"></script>
    
    <script src="//ulogin.ru/js/ulogin.js"></script>

	<script type="text/javascript">
    	$(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $(".offer").owlCarousel({
                items:1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
            });     
            
            $(".card-product").owlCarousel({
                items:6,
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
            });
            
            
    	});
    	
        function initialise()
        {
            var mapBlock = document.getElementById("map");
            if(mapBlock !== null)
            {
                var myLatlng = new google.maps.LatLng(42.334000, 69.586770);
                var mapOptions = {
                  zoom: 16,
                  center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    // title:"111",
                    label:"Медицинское оборудование",
                });
                marker.setMap(map);
            }
        }
        initialise();
	</script>	

     @yield('script')
</body>
</html>
