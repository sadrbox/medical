@extends('layouts.admin')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.new') }}</div>
                <form action="{{ url()->route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Наименование</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('category_id')) ? 'has-error' : '' }}">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0">---</option>
                                        @foreach($categories as $select)
                                            <option {{ (old('category_id') == $select->id) ? 'selected' : '' }} value="{{$select->id}}">{{$select->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('description')) ? 'has-error' : '' }}">
                                    <label for="description">Описание</label>
                                    <textarea name="description" class="form-control" rows="20">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('price')) ? 'has-error' : '' }}">
                                    <label for="price">Цена</label>
                                    <input type="text" name="price" class="form-control" value="{{old('price')}}" />
                                </div>
                                <div class="form-group {{($errors->has('price_partner')) ? 'has-error' : '' }}">
                                    <label for="price_partner">Цена партнера</label>
                                    <input type="text" name="price_partner" class="form-control" value="{{old('price_partner')}}" />
                                </div>
                                <div class="form-group">
                                    <div class="product_image">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Загрузить изображение</div>
                                    </div>
                                    <input type="file" name="image" class="hidden" accept="image/gif, image/jpeg, image/png" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o mr-10" aria-hidden="true"></i>Сохранить</button>
                                <a href="{{url()->route('admin.product.index')}}" class="btn btn-default">Закрыть</a>
                            </div>
                            <div class="col-md-8"></div>
                        </div>    
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(function(){
    $(".product_image").on('click', function(event){
        event.preventDefault();
        var $input = $("[name=image]");
        $input.click();
    });
    /****************/
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.product_image').html('');
            $('.product_image').css("background-image", "url("+e.target.result+")");
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    
    $("[name=image]").change(function() {
      readURL(this);
    });

});
</script>
@endsection