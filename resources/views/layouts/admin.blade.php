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
                        <li><a href="{{ url()->route('admin.article.index') }}">{{ trans('app.article') }}</a></li>
                        <li><a href="{{ url()->route('admin.product.index') }}">{{ trans('app.product') }}</a></li>
                        <li><a href="{{ url()->route('admin.call.index') }}">{{ trans('app.call') }}</a></li>
                        <li><a href="{{ url()->route('admin.page.index') }}">{{ trans('app.page') }}</a></li>
                        <li><a href="{{ url()->route('admin.partner.index') }}">{{ trans('app.partner') }}</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Метаданные <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url()->route('admin.category.index') }}">{{ trans('app.category') }}</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url()->route('admin.offer.index') }}">{{ trans('app.offer') }}</a></li>
                          </ul>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url()->route('site.index') }}">Сайт</a></li>
                        <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out mr-10"></i>Выход({{ Auth::user()->username }})</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @include('layouts.breadcrumbs')
        @include('layouts.messages')
        @yield('content')
    </section>
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
    <script src="/extensions/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
    	$(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            /* Wysiwyg */
            tinymce.init({ 
                selector:'textarea', 
                language_url : '/extensions/tinymce/langs/ru.js',
                plugins: 'image imagetools code table fullscreen lists',
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | outdent indent | table | numlist bullist | link image editimage | fullscreen',
        
                relative_urls: false,
                images_upload_handler: function (blobInfo, success, failure) {
                    
                    formData = new FormData();
                    formData.append('image', blobInfo.blob(), blobInfo.filename());
          
                    $.ajax({
                        url: "/admin/upload",
                        type: "POST",
                        data: formData,
                        success: function (response) {
                            var obj = JSON.parse(response);
                            // var aasd = JSON.parse(obj.url);
                            console.log(obj.url);
                            success(obj.url);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
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
