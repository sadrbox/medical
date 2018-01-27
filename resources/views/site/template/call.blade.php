@extends('layouts.app') 

@section('template') 
<div class="form-template">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="mt-100">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade in">
                        <strong>{!! Session::get('message') !!}</strong>
                    </div>
                    @else
                    <form action="{{ url()->route('site.querycallme') }}" method="POST" class="call-form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <h2>Хочешь узнать больше?</h2>
                            <hr>
                        </div>
                        <br>
                        <div class="form-group {{($errors->has('name')) ? 'has-error' : '' }}">
                            <input type="text" id="name" name="name" placeholder="Имя" class="form-control input-lg" required />
                        </div>
                        <div class="form-group {{($errors->has('phone')) ? 'has-error' : '' }}">
                            <input type="text" id="phone" name="phone" value="+7" placeholder="Контактный телефон" class="form-control input-lg" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block btn-query-call"><i class="fa fa-paper-plane mr-10" aria-hidden="true"></i>Перезвонить мне</button>
                        </div>
                    </form>
                @endif
                    <br>
                    <br>
                    <div class="form-group" style="text-align:center;">
                        <a href="{{ url()->route('site.index') }}" class="btn btn-close-call"><i class="fa fa-times-circle-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<style>

.mt-100{
    margin-top:100px;
}

.call-form{
    color:#fff;
}
.btn-query-call{
    font-size:24px;
    font-weight:800 !important; 
    text-transform:uppercase;
    text-shadow:0px 0px 1px #000;
}
.btn-close-call{

    font-size:34px;
    font-weight:800 !important; 
    text-transform:uppercase;
    text-shadow:0px 0px 1px #000;
    color:#fff;  
}
.form-template {
    z-index: 999;
    position: absolute;
    top:0;
    bottom:0;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    width:100%;
    background-color:rgba(0, 0, 0, 0.50);
}

#app-layout {
    position: absolute;
    z-index: 99;
    top:0;
    bottom:0;
    left: 0;
    right: 0;

    filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius='10');
    -webkit-filter: blur(10px);
    filter: blur(10px);
}
</style>
@endsection 
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#phone").mask('+7(000) 000-00-00');
});
</script>
@endsection
