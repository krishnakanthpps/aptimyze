@extends('layouts.master')
@section('content')
    {{-- */$nav_item = 1;/* --}}
    <div class="container">
        <div class="col-md-12 col-lg-10 col-sm-12 col-xs-12 uac_container col-lg-offset-1">
            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
                @include('user.sidebar')
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12 col-lg-9">
                <div class="uac_profile">
                    <div class="uac_sidebar_header">
                        {{$user->name}}
                    </div>
                    <div class="uac_profile_itmes">
                        <li><span class="uac_profile_item" >NAME : {{$user->name}}</span></li>
                        <li><span class="uac_profile_item" >EMAIL ID : {{$user->email}}</span></li>
                        <li><span class="uac_profile_item" >MOBILE NUMBER : {{$user->phone}}</span></li>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('pagejquery')
    <script src="/assets/js/jquery-ui-1.10.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function ()
        {

        });
    </script>
@stop
