@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="show-post">
                <h1>{{ $product->title }}</h1>
                <?php 
                    if(is_file(public_path('img/products/'.$product->img))){
                        $image = asset('img/products/'.$product->img);
                    }else{$image = '';}
                ?>
                @if($image)
                <img style="max-width:120px;max-height:120px" class="img-thumbnail" src="{{ $image }}" />
                @endif 
                <div>{!! $product->description !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection