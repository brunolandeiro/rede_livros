@extends('layouts.app')

@section('content')

<!-- The Grid -->
<div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
            <div class="w3-container">
                <h4 class="w3-center">{{ Auth::user()->name }}</h4>
                <p class="w3-center">
                    <a href="#" onclick="document.getElementById('id01').style.display='block'" >
                        <img src="{{asset('/W3.CSS/avatar3.png')}}" class="w3-circle img_perfil" style="height:106px;width:106px" alt="Avatar">
                    </a>
                    <!-- Modal imagem perfil -->
                    <div id="id01" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-top" style="max-width:600px">

                            <div class="w3-center"><br>
                                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-pale-red w3-display-topright" title="Close Modal">&times;</span>
                                <img src="{{asset('/W3.CSS/avatar3.png')}}" id="preview" alt="Avatar" style="height:106px;width:106px" class="w3-circle w3-margin-top">
                            </div>

                            <form class="w3-container" action="/action_page.php" enctype="multipart/form-data">
                                 {{ csrf_field() }}
                                <div class="w3-section">
                                    <input type="file" id="img_perfil" name="img_perfil" accept="image/*" required>
                                    <button class="w3-button w3-block w3-theme-l1 w3-section w3-padding" type="submit">Enviar</button>
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
                <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-text-theme"></i>
                    @if(Auth::user()->profissao)pencil
                    Auth::user()->profissao
                    @else
                    Profissão
                    @endif
                </p>
                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>
                    @if(Auth::user()->aniversario)
                    Auth::user()->aniversario
                    @else
                    Data Nascimento
                    @endif
                </p>
                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>
                    <a href="#">Alterar informações</a>
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
