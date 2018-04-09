@extends('layouts.app')

@section('content')
@php
$display_blue = 'display:block';
$display_green = 'display:none';
$display_red = 'display:none';

$linha_blue = 'w3-border-blue';
$linha_green = 'w3-border-white';
$linha_red = 'w3-border-white';
@endphp

@if(session('estante_atual'))
    @php
        $display_blue = session('estante_atual') == 1 || session('estante_atual') == 4 ? 'display:block' : 'display:none';
        $display_green = session('estante_atual') == 2 ? 'display:block' : 'display:none';
        $display_red = session('estante_atual') == 3 ? 'display:block' : 'display:none';

        $linha_blue = session('estante_atual') == 1 ? 'w3-border-blue' : 'w3-border-white';
        $linha_green = session('estante_atual') == 2 ? 'w3-border-green' : 'w3-border-white';
        $linha_red = session('estante_atual') == 3 ? 'w3-border-red' : 'w3-border-white';
    @endphp
@endif
<!-- Menssagens de erro -->
@if(session('erro'))
<div class="w3-row">
    <div class="w3-col m10">
        <div class="w3-panel w3-pale-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'" class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <h3><i class="icon fa fa-info"></i> Notificação!</h3>
            <p>{{session('erro')}}</p>
        </div>
    </div>
</div>
@endif
<!-- END / Menssagens de erro -->

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
            @if($dono)
            <!-- Box form titulo e autor -->
            <div class="w3-row">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white w3-margin-bottom w3-margin-left w3-margin-right">
                        <div class="w3-container w3-padding">
                            <h6 class="w3-opacity">Adicione um livro a sua estante!</h6>
                            <form method="post" action="{{route('AddLivro')}}">
                                {{ csrf_field() }}
                                <input class="w3-input" type="text" name="titulo" value="{{old('titulo')}}" placeholder="Título" request>
                                <!-- @if ($errors->has('titulo'))
                                <div class="w3-panel w3-pale-red w3-round w3-text-red">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </div>
                                @endif -->
                                <input class="w3-input" type="text" name="autor" value="{{old('autor')}}" placeholder="Autor">
                                <br><button type="submit" class="w3-button w3-theme w3-right">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Box form titulo e autor -->
            @endif
            <!-- Tabs estante de livros -->
            @if (session('alerta'))
            <div class="w3-panel w3-pale-green w3-round w3-text-green w3-margin">
                <p style="font-size: 18px;">Livro cadastrado com sucesso! <i class="fa fa-smile-o"></i></p>
                <p> {{session('alerta')}}</p>
            </div>
            @endif
            @if ($errors->all())
            <div class="w3-panel w3-pale-red w3-round w3-text-red w3-margin">
                <p style="font-size: 18px;"><i class="fa fa-exclamation-triangle"> </i>Ops!</p>
                <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                <?php //break ?>
                @endforeach
                <ul>
            </div>
            @endif
            <div class="w3-card w3-white w3-round w3-margin-left w3-margin-right">
                <a href="javascript:void(0)" onclick="openCity(event, 'London', 'blue');" class="w3-text-blue">
                    <div id="blue" class="w3-third tablink w3-bottombar  w3-hover-border-blue w3-padding {{$linha_blue}}"><i class="fa fa-bookmark fa-fw w3-margin-right "></i>Quero ler</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Paris', 'green');" class="w3-text-green">
                    <div id="green" class="w3-third tablink w3-bottombar w3-hover-border-green w3-padding  {{$linha_green}}"><i class="fa fa-bookmark fa-fw w3-margin-right "></i>Lidos</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo', 'red');" class="w3-text-red">
                    <div id="red" class="w3-third tablink w3-bottombar  w3-hover-border-red w3-padding  {{$linha_red}}"><i class="fa fa-bookmark fa-fw w3-margin-right"></i>Lendo</div>
                </a>
                <!-- ESTANTE DE QUERO LER -->
                <div id="London" class="w3-container city" style="{{$display_blue}}">
                    <div class="w3-row">
                    @foreach($livros as $livro)
                        @if($livro->estante == 1)
                        @php $form_quero = 'quero-'.$livro->livro_id; $estante_quero = 'blue-'.$livro->livro_id; @endphp
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-blue w3-round" style="width:25%">

                                <a href="/livro/mostrar/{{$livro->livro_id}}/{{$usuario->id}}">
                                    <img src="{{$livro->img}}" style="width:100%" height="270">
                                </a>
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444; width:100%;">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                                @if($dono)
                                <div class="w3-display-bottomleft">
                                    <div class="w3-tooltip w3-bar">
                                        <button class="w3-button w3-white w3-border w3-border-blue w3-padding-small" title="Quero ler"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                        <div class="w3-text w3-animate-fade">
                                            <form id="{{$form_quero}}" action="{{route('trocaEstante')}}" method="post">
                                                {{ csrf_field() }}
                                                <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                                <input name="estante" type="hidden" id="{{$estante_quero}}">
                                                <button class="w3-button w3-white w3-border w3-border-green w3-padding-small"  type="button" title="Lido" onclick="mudaEstante('{{$form_quero}}','{{$estante_quero}}',2)"><i class="fa fa-bookmark w3-text-green"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-red w3-padding-small"  type="button" title="Lendo" onclick="mudaEstante('{{$form_quero}}','{{$estante_quero}}',3)"><i class="fa fa-bookmark w3-text-red"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-red w3-padding-small "  type="button" title="Excluir" onclick="mudaEstante('{{$form_quero}}','{{$estante_quero}}',4)"><i class="fa fa-remove w3-text-red"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
                <!-- END ESTANTE DE QUERO LER -->
                <!-- ESTANTE DE lIDOS -->
                <div id="Paris" class="w3-container city" style="{{$display_green}}">
                    @foreach($livros as $livro)
                        @if($livro->estante == 2)
                        @php $form_lido = 'lido-'.$livro->livro_id; $estante_green = 'green-'.$livro->livro_id; @endphp
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-green w3-round" style="width:25%">
                                <a href="/livro/mostrar/{{$livro->livro_id}}/{{$usuario->id}}">
                                    <img src="{{$livro->img}}" style="width:100%" height="270">
                                </a>
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444; width:100%;">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                                @if($dono)
                                <div class="w3-display-bottomleft">
                                    <div class="w3-tooltip w3-bar">
                                        <button class="w3-button w3-white w3-border w3-border-green w3-padding-small" title="Lido"><i class="fa fa-bookmark w3-text-green"></i></button>
                                        <div class="w3-text w3-animate-fade">
                                            <form id="{{$form_lido}}" action="{{route('trocaEstante')}}" method="post">
                                                {{ csrf_field() }}
                                                <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                                <input name="estante" type="hidden" id="{{$estante_green}}">
                                                <button class="w3-button w3-white w3-border w3-border-blue w3-padding-small" type="button"   title="Quero ler" onclick="mudaEstante('{{$form_lido}}','{{$estante_green}}',1)"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-red w3-padding-small" type="button"   title="Lendo" onclick="mudaEstante('{{$form_lido}}','{{$estante_green}}',3)"><i class="fa fa-bookmark w3-text-red"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-red w3-padding-small "  type="button" title="Excluir" onclick="mudaEstante('{{$form_lido}}','{{$estante_green}}',4)"><i class="fa fa-remove w3-text-red"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- END ESTANTE DE LIDOS -->
                <!-- ESTANTE DE LENDO -->
                <div id="Tokyo" class="w3-container city" style="{{$display_red}}">
                    @foreach($livros as $livro)
                        @if($livro->estante == 3)
                        @php $form_lendo = 'lendo-'.$livro->livro_id; $estante_red = 'red-'.$livro->livro_id; @endphp
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-red w3-round" style="width:25%">
                                <a href="/livro/mostrar/{{$livro->livro_id}}/{{$usuario->id}}">
                                    <img src="{{$livro->img}}" style="width:100%" height="270">
                                </a>
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444; width:100%;">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                                @if($dono)
                                <div class="w3-display-bottomleft">
                                    <div class="w3-tooltip w3-bar">
                                        <button class="w3-button w3-white w3-border w3-border-red w3-padding-small" title="Lendo"><i class="fa fa-bookmark w3-text-red"></i></button>
                                        <div class="w3-text w3-animate-fade">
                                            <form id="{{$form_lendo}}" action="{{route('trocaEstante')}}" method="post">
                                                {{ csrf_field() }}
                                                <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                                <input name="estante" type="hidden" id="{{$estante_red}}">
                                                <button class="w3-button w3-white w3-border w3-border-blue w3-padding-small"  type="button"  title="Quero ler" onclick="mudaEstante('{{$form_lendo}}','{{$estante_red}}',1)"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-green w3-padding-small"   type="button" title="Lidos" onclick="mudaEstante('{{$form_lendo}}','{{$estante_red}}',2)"><i class="fa fa-bookmark w3-text-green"></i></button>
                                                <button class="w3-button w3-white w3-border w3-border-red w3-padding-small "  type="button" title="Excluir" onclick="mudaEstante('{{$form_lendo}}','{{$estante_red}}',4)"><i class="fa fa-remove w3-text-red"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- END ESTANTE DE LENDO -->
            </div>

        </div>

        <!-- END Tabs estante de livros -->
        <!-- End Middle Column -->
    </div>
    <!-- END ROW -->

</div>

@endsection
