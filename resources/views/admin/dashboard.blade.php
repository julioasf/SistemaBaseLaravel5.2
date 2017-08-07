@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <ul>
                        <li><a href="{{ route('googleNews') }}" class="link-edit">Google News</a></li>
                        <li><a href="{{ route('adminUsers') }}" class="link-edit">Usu&aacute;rios</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
