@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('app.edit') }}</div>
                <form action="{{ url()->route('admin.product.update', ['product'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                    {{method_field('PUT')}} 
                    {{csrf_field()}}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('title')) ? 'has-error' : '' }}">
                                    <label for="title">Наименование</label>
                                    <input type="text" name="title" class="form-control" value="{{$product->title}}" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('category_id')) ? 'has-error' : '' }}">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="0">---</option>
                                        @foreach($categories as $select)
                                            <option <?= ($product->category_id == $select->id) ? "selected" : "" ?> value="{{$select->id}}">{{$select->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group {{($errors->has('description')) ? 'has-error' : '' }}">
                                    <label for="description">Описание</label>
                                    <textarea name="description" id="editor" class="form-control" rows="20">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{($errors->has('price')) ? 'has-error' : '' }}">
                                    <label for="price">Цена</label>
                                    <input type="text" name="price" class="form-control"  value="{{$product->price}}" />
                                </div>
                                <div class="form-group">
                                    <div class="product_image" style="background-image: url({{$product->image}})">
                                        @if (empty($product->image))
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <div>Загрузить изображение</div>
                                        @endif
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
    /* link image */
    $(".product_image").on('click', function(event){
        event.preventDefault();
        var $input = $("[name=image]");
        $input.click();
    });

  
    /* show image preview */
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
    
    /* Wysiwyg */
    tinymce.init({ 
        selector:'textarea', 
        language_url : '/extensions/tinymce/langs/ru.js',
        plugins: 'image imagetools code table fullscreen',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | outdent indent | table | link image editimage | fullscreen',

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
</script>
@endsection