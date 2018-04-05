@extends('layouts.app')

@section('content')
<!-- The Grid -->
<div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
        <!-- Profile / resources/views/box_profile.blade.php -->
        @if($dono)
            @include('box_profile_dono')
        @else
            @include('box_profile')
        @endif
        <!-- END Profile -->
    </div>
    <!-- END Left Column -->
    <!-- Middle Column -->
    <div class="w3-col m7">
        <div class="w3-container w3-card w3-white w3-round w3-margin-left w3-margin-bottom"><br>
            <img src="{{$livro->img}}" alt="{{$livro->titulo}}" height="270" class="w3-left w3-border w3-margin-right">
            <h4>{{$livro->titulo}}</h4>
            <p>{{$livro->autor}}</p>
            <hr class="w3-clear">
            <?php echo $livro->descricao ?>
            <!-- <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Like</button>
            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button> -->
            <div class="w3-container ">
                <button type="submit" class="w3-button w3-theme w3-right w3-margin-bottom"><i class="fa fa-pencil fa-fw w3-margin-right w3-text-white"></i>Editar Informaçoes</button>
            </div>
        </div>
    </div>
</div>
<!-- END Middle Column -->
</div>
@endsection
