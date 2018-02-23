@extends('layouts.app')

@section('content')
<!-- The Grid -->
<div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
        <!-- Profile / resources/views/box_profile.blade.php -->
        @include('box_profile')
        <!-- END Profile -->
    </div>
    <!-- END Left Column -->
    <!-- Middle Column -->
    <div class="w3-col m7">
        <div class="w3-container w3-card w3-white w3-round w3-margin-left"><br>
            <img src="{{$livro->img}}" alt="{{$livro->titulo}}" height="270" class="w3-left w3-border w3-margin-right">
            <span class="w3-right w3-opacity">1 min</span>
            <h4>{{$livro->titulo}}</h4>
            <hr class="w3-clear">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-half">
                    <img src="{{asset('/W3.CSS/lights.jpg')}}" style="width:100%" alt="Northern Lights" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                    <img src="{{asset('/W3.CSS/nature.jpg')}}" style="width:100%" alt="Nature" class="w3-margin-bottom">
                </div>
            </div>
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Like</button>
            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>
        </div>
    </div>

    </div>
    <!-- END Middle Column -->
</div>
@endsection
