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
            <div class="w3-row">
                <div class="w3-col m3">
                    <label>
                        <input type="file" class="hide" id="img_livro" name="img_livro" accept="image/*">
                        <img src="{{$livro->img}}" alt="{{$livro->titulo}}" height="270" width="174.7" class="w3-left w3-border w3-margin-right img_livro" id="preview-livro">
                    </label>
                </div>
                <div class="w3-col m9">
                    <form method="post" action="{{route('updateLivro')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="livro_id" value="{{$livro->livro_id}}"/>

                        <input class="w3-input" type="text" name="titulo" value="{{old('titulo')?old('titulo'):$livro->titulo}}" placeholder="Título" request>
                        <label class="w3-text-theme">Título</label>
                        @if ($errors->has('titulo'))
                        <div class="w3-panel w3-pale-red w3-round w3-text-red">
                            <strong>{{ $errors->first('titulo') }}</strong>
                        </div>
                        @endif
                        <input class="w3-input" type="text" name="autor" value="{{old('autor')?old('autor'):$livro->autor}}" placeholder="Autor">
                        <label class="w3-text-theme">Autor</label>
                        @if ($errors->has('autor'))
                        <div class="w3-panel w3-pale-red w3-round w3-text-red">
                            <strong>{{ $errors->first('autor') }}</strong>
                        </div>
                        @endif
                        <textarea name="descricao" placeholder="Descrição" id="wysihtml5-textarea">{{old('descricao')?old('descricao'):$livro->descricao}}</textarea>
                        <label class="w3-text-theme">Descrição</label>
                        @if ($errors->has('descricao'))
                        <div class="w3-panel w3-pale-red w3-round w3-text-red">
                            <strong>{{ $errors->first('descricao') }}</strong>
                        </div>
                        @endif
                        <br><button type="submit" class="w3-button w3-theme w3-right">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Middle Column -->
</div>
@endsection
