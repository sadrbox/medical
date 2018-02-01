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
    <!--<div>-->
    <!--    <a href="{{ url('/partner/login') }}">partner login</a> | -->
    <!--    <a href="{{ url('/partner/register') }}">partner register</a> | -->
    <!--    <a href="{{ url('/partner/logout') }}">partner logout</a>-->
    <!--</div>    -->
    <!--<div>-->
    <!--    <a href="{{ url('/admin/login') }}">admin login</a> | -->
    <!--    <a href="{{ url('/admin/register') }}">admin register</a> | -->
    <!--    <a href="{{ url('/admin/logout') }}">admin logout</a>-->
    <!--</div>-->

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
                <br>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="business-slogan">Здесь уникальное торговое предложение (оффер)</h1>
                        </div>
                    </div>
                </div>
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
    <section class="footer">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <p>Республика Казахстан, г. Алматы, A05C9Y3 ул.Гоголя, 111, уг. ул.Наурызбай батыра</p>
                </div>
                <div class="col-md-3">
                    @if( ! Auth::guard('partner')->check())
                    <a class="pull-right" href="{{ url('/admin') }}">Администратор</a>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        
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
