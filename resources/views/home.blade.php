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
                <h4 class="w3-center">{{ $usuario->name }}</h4>
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
                    <script>
                    $("document").ready(function(){
                        // Preview da img
                        $("#img_perfil").change(function() {
                            readURL(this);
                        });

                        function readURL(input) {

                            if (input.files && input.files[0]) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    $('#preview').attr('src', e.target.result);
                                }

                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    });
                    </script>

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
        <div class="w3-col m3">

        </div>
    <!-- END ROW -->
    </div>

@endsection
