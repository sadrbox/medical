@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">{{ $product->title }}</div>
                <div class="panel-body">
                    <p>{{ $product->title }}</p>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->price }}</p>
                </div>
            </div>
            
        </div> 
    </div>
</div>
@endsection
