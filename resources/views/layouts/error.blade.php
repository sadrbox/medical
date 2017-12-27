@if($errors->any())
<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Alert</h4>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    <?php /*dd($errors);*/ ?>
</div>
@endif
 