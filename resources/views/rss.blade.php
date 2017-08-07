@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Google News - RSS</div>

                <div class="panel-body">
                    <ul>
                        @foreach ($rss->channel->item as $item)
                            <?php $count++; ?>
                            <li><a href='{{$item->link}}' target='_blank'>{{$item->title}}</a></li><br />

                            @if ($count == $limit)
                                @break;
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
