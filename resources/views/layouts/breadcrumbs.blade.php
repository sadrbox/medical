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