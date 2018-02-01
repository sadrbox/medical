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