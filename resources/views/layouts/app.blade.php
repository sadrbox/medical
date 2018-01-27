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
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font:16px 'Source Sans Pro', sans-serif;
        }
    </style>
</head>
<body>
<div id="app-layout">
    @if (request()->route()->getPrefix() !== '/admin')
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
                @if (request()->is('site'))
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
    @endif
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
                    @if (Auth::check())
                        @if (request()->route()->getPrefix() == '/admin')
                        <li><a href="{{ url()->route('admin.article.index') }}">{{ trans('app.article') }}</a></li>
                        <li><a href="{{ url()->route('admin.product.index') }}">{{ trans('app.product') }}</a></li>
                        <li><a href="{{ url()->route('admin.call.index') }}">{{ trans('app.call') }}</a></li>
                        <li><a href="{{ url()->route('admin.page.index') }}">{{ trans('app.page') }}</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Метаданные <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url()->route('admin.category.index') }}">{{ trans('app.category') }}</a></li>
                          </ul>
                        </li>
                        @endif
                    @endif
                    @if(request()->route()->getPrefix() !== '/admin')
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
                    @endif
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            @if (request()->route()->getPrefix() == '/admin')
                            <li><a href="{{ url()->route('site.index') }}">Сайт</a></li>
                            @else
                            <li><a href="{{ url()->route('admin.index') }}">{{ trans('app.panel') }}</a></li>
                            @endif
                            <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out mr-10"></i>Выход({{ Auth::user()->name }})</a></li>
                        @elseif(request()->route()->getPrefix() !== '/admin')
                        <li><a href="{{ url('/partner/login') }}">{{ trans('app.partner') }}</a></li>
                        <li><a href="{{ url('/admin') }}">{{ trans('app.panel') }}</a></li>
                        @elseif(request()->route()->getPrefix() == '/admin')
                        <li><a href="{{ url()->route('site.index') }}">Сайт</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
                @if(Session::has('breadcrumbs'))
                    <ol class="breadcrumb">
                        @foreach(Session::get('breadcrumbs') as $item)
                            @if($item['route'] <> null && $item['arg'] <> null)
                            <li><a href="{{ url()->route($item['route'], $item['arg']) }}">{{$item['name']}}</a></li>
                            @elseif($item['route'] <> null && $item['arg'] == null)
                            <li><a href="{{ url()->route($item['route']) }}">{{$item['name']}}</a></li>
                            @else
                            <li>{{$item['name']}}</li>
                            @endif
                            
                        @endforeach
                    </ol>
                    <?php session()->forget('breadcrumbs'); ?>
                @endif
        </div>
        <div class="container">
            @if(Session::has('message') || $errors->has())
            <?php 
                    $mesTitle = "";
                if(session('type') == "danger" || $errors->has()) {
                    $mesType = "danger";
                    $mesTitle = "Предупреждение";
                    $mesIcon = '<i class="fa fa-exclamation-triangle mr-10" aria-hidden="true"></i>';
                }
                elseif(session('type') == "warning"){
                    $mesType = "warning";
                    // $mesTitle = "Служебное уведомление";
                    $mesIcon = '<i class="fa fa-exclamation-circle mr-10" aria-hidden="true"></i>';
                }
                else{
                    $mesType = "success";
                    // $mesTitle = "Служебное уведомление";
                    $mesIcon = '<i class="fa fa-exclamation-circle mr-10" aria-hidden="true"></i>';
                }
            ?>
                <div class="alert alert-{{$mesType}}">
                    @if($mesTitle)
                    <h4>{!!$mesIcon!!}{{$mesTitle}}</h4> 
                    <hr>   
                    @endif
                    @if(Session::get('message'))
                        <p>@if($mesType == 'danger')
                                <i class="fa fa-caret-right mr-10" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-check mr-10" aria-hidden="true"></i>
                            @endif
                            {{ Session::get('message') }}</p>
                    @endif
                    @if($errors->has())
                    <ul>
                        @foreach($errors->all() as $error)
                        <li><i class="fa fa-caret-right mr-10" aria-hidden="true"></i>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            @endif
        </div>
        @yield('content')
    </section>
    @if (request()->route()->getPrefix() !== '/admin')
    <section class="footer">
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Республика Казахстан, г. Алматы, A05C9Y3 ул.Гоголя, 111, уг. ул.Наурызбай батыра</p>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        
    </section>
    @endif
</div>
    @yield('template')
    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    
    <!-- google maps location -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    
    <!-- jquery-confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    
    <!-- wysiwyg-->
    <script src="/extensions/tinymce/tinymce.min.js?<?php echo time(); ?>"></script>
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
