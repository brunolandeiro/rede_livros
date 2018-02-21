@extends('layouts.app')

@section('content')
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
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container">
                <p class="w3-center">{{ $usuario->name }}</p>
                <p class="w3-center">
                    <a href="#" onclick="document.getElementById('id01').style.display='block'" >
                        <img src="{{$img}}" class="w3-circle img_perfil" style="height:106px;width:106px" alt="Avatar">
                    </a>
                    <!-- Modal imagem perfil -->
                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-top" style="max-width:600px">

                            <div class="w3-center"><br>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-pale-red w3-display-topright" title="Close Modal">&times;</span>
                                <img src="{{$img}}" id="preview" alt="Avatar" style="height:106px;width:106px" class="w3-circle w3-margin-top">
                            </div>

                            <form class="w3-container" method="post" action="{{route('UpdatePerfil')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="w3-section">
                                    <input type="file" id="img_perfil" name="img_perfil" accept="image/*">
                                    <br>

                                    <label class="w3-text-theme" >Qual é a sua Profissão? <i class="fa fa-briefcase fa-fw w3-margin-right"></i></label>
                                    <input class="w3-input" type="text" name="profissao" value="{{old('profissao') ? old('profissao') : $usuario->profissao}}">

                                    <label class="w3-text-theme" >Em que ano você nasceu? <i class="fa fa-birthday-cake fa-fw w3-margin-right"></i></label>
                                    <input class="w3-input" type="date" name="nascimento" value="{{old('nascimento') ? old('nascimento') : $usuario->nascimento}}">

                                    <button class="w3-button w3-block w3-theme-l1 w3-section w3-padding" type="submit">Editar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- END Modal imagem perfil -->
                </p>
                <hr>
                <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-text-theme"></i>{{$usuario->profissao}}</p>
                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>{{date('d/m/Y', strtotime($usuario->nascimento))}}</p>
                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>
                    <a href="#" onclick="document.getElementById('id01').style.display='block'">Alterar informações</a>
                </div>
            </div>
            <br>


            <!-- END Left Column -->
        </div>
        <!-- Middle Column -->
        <div class="w3-col m7">
            <!-- Box form titulo e autor -->
            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h6 class="w3-opacity">Adicione um livro a sua estante!</h6>
                            <form method="post" action="{{route('AddLivro')}}">
                                {{ csrf_field() }}
                                <input class="w3-input" type="text" name="titulo" value="{{old('titulo')}}" placeholder="Título" request>
                                @if ($errors->has('titulo'))
                                <div class="w3-panel w3-pale-red w3-round w3-text-red">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </div>
                                @endif
                                <input class="w3-input" type="text" name="autor" value="{{old('autor')}}" placeholder="Autor">
                                <button type="submit" class="w3-button w3-theme w3-right">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Box form titulo e autor -->
            <!-- Tabs estante de livros -->

            <div class="w3-card w3-white w3-round w3-margin">
                <a href="javascript:void(0)" onclick="openCity(event, 'London', 'blue');" class="w3-text-blue">
                    <div id="blue" class="w3-third tablink w3-bottombar  w3-hover-border-blue w3-padding w3-border-blue"><i class="fa fa-book fa-fw w3-margin-right "></i>Quero ler</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Paris', 'green');" class="w3-text-green">
                    <div id="green" class="w3-third tablink w3-bottombar w3-hover-border-green w3-padding  w3-border-white"><i class="fa fa-book fa-fw w3-margin-right "></i>Lidos</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo', 'red');" class="w3-text-red">
                    <div id="red" class="w3-third tablink w3-bottombar  w3-hover-border-red w3-padding  w3-border-white"><i class="fa fa-book fa-fw w3-margin-right"></i>Lendo</div>
                </a>
                <!-- ESTANTE DE QUERO LER -->
                <div id="London" class="w3-container city" style="display:block">
                    <div class="w3-row">
                    @foreach($livros as $livro)
                        @if($livro->estante == 1)
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-blue w3-round" style="width:25%">

                                <img src="{{$livro->img}}" style="width:100%" height="270">
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                            <div class="w3-display-bottomleft">
                                <div class="w3-tooltip">
                                    <button class="w3-btn" title="Quero ler"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                    <div class="w3-text w3-animate-fade">
                                        <form id="form-quero" action="{{route('trocaEstante')}}" method="post">
                                            {{ csrf_field() }}
                                            <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                            <input name="estante" type="hidden" id="estante">
                                            <button class="w3-button w3-bar-item"  type="button" title="Lido" onclick="mudaEstante('form-quero','estante',2)"><i class="fa fa-bookmark w3-text-green"></i></button>
                                            <button class="w3-button w3-bar-item"  type="button" title="Lendo" onclick="mudaEstante('form-quero','estante',3)"><i class="fa fa-bookmark w3-text-red"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>
                <!-- END ESTANTE DE QUERO LER -->
                <!-- ESTANTE DE lIDOS -->
                <div id="Paris" class="w3-container city" style="display:none">
                    @foreach($livros as $livro)
                        @if($livro->estante == 2)
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-green w3-round" style="width:25%">
                                <img src="{{$livro->img}}" style="width:100%" height="270">
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                            <div class="w3-display-bottomleft">
                                <div class="w3-tooltip">
                                    <button class="w3-btn" title="Lido"><i class="fa fa-bookmark w3-text-green"></i></button>
                                    <div class="w3-text w3-animate-fade">
                                        <form id="form-lido" action="{{route('trocaEstante')}}" method="post">
                                            {{ csrf_field() }}
                                            <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                            <input name="estante" type="hidden" id="estante-green">
                                            <button class="w3-button w3-bar-item" type="button"   title="Quero ler" onclick="mudaEstante('form-lido','estante-green',1)"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                            <button class="w3-button w3-bar-item" type="button"   title="Lendo" onclick="mudaEstante('form-lido','estante-green',3)"><i class="fa fa-bookmark w3-text-red"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- END ESTANTE DE LIDOS -->
                <!-- ESTANTE DE LENDO -->
                <div id="Tokyo" class="w3-container city" style="display:none">
                    @foreach($livros as $livro)
                        @if($livro->estante == 3)
                        <div class="w3-third w3-display-container w3-margin w3-leftbar w3-rightbar w3-topbar w3-bottombar w3-hover-border-red w3-round" style="width:25%">

                                <img src="{{$livro->img}}" style="width:100%" height="270">
                                <div class="w3-display-topleft w3-text-white w3-black w3-opacity" style="text-shadow:1px 1px 0 #444">
                                    <p>{{$livro->titulo}}</p>
                                </div>
                            <div class="w3-display-bottomleft">
                                <div class="w3-tooltip">
                                    <button class="w3-btn" title="Lendo"><i class="fa fa-bookmark w3-text-red"></i></button>
                                    <div class="w3-text w3-animate-fade">
                                        <form id="form-lendo" action="{{route('trocaEstante')}}" method="post">
                                            {{ csrf_field() }}
                                            <input name="livro_id" type="hidden" value="{{$livro->livro_id}}">
                                            <input name="estante" type="hidden" id="estante-red">
                                            <button class="w3-button w3-bar-item"  type="button"  title="Lidos" onclick="mudaEstante('form-lendo','estante-red',1)"><i class="fa fa-bookmark w3-text-blue"></i></button>
                                            <button class="w3-button w3-bar-item"   type="button" title="Quero ler" onclick="mudaEstante('form-lendo','estante-red',2)"><i class="fa fa-bookmark w3-text-green"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
    <!-- javascript -->
    <script src="{{asset('/js/home.js')}}"></script>
    <!-- END javascript -->
</div>

@endsection
