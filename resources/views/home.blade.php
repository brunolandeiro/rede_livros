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

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <button onclick="myFunction(&#39;Demo1&#39;)" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-book fa-fw w3-margin-right"></i> Lidos</button>
                    <div id="Demo1" class="w3-hide w3-container">
                        <p>Some text..</p>
                    </div>
                    <button onclick="myFunction(&#39;Demo2&#39;)" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-book fa-fw w3-margin-right"></i> Lendo</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <p>Some other text..</p>
                    </div>
                    <button onclick="myFunction(&#39;Demo3&#39;)" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-book fa-fw w3-margin-right"></i> Quero ler</button>
                    <div id="Demo3" class="w3-hide w3-container">
                        <div class="w3-row-padding">
                            <br>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/lights.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/nature.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/mountains.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/forest.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/nature.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                            <div class="w3-half">
                                <img src="{{asset('/W3.CSS/fjords.jpg')}}" style="width:100%" class="w3-margin-bottom">
                            </div>
                        </div>
                    </div>
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
                    <div id="blue" class="w3-third tablink w3-bottombar  w3-hover-border-blue w3-padding w3-border-blue"><i class="fa fa-book fa-fw w3-margin-right "></i>London</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Paris', 'green');" class="w3-text-green">
                    <div id="green" class="w3-third tablink w3-bottombar w3-hover-border-green w3-padding  w3-border-white"><i class="fa fa-book fa-fw w3-margin-right "></i>Paris</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Tokyo', 'red');" class="w3-text-red">
                    <div id="red" class="w3-third tablink w3-bottombar  w3-hover-border-red w3-padding  w3-border-white"><i class="fa fa-book fa-fw w3-margin-right"></i>Tokyo</div>
                </a>

                <div id="London" class="w3-container city" style="display:block">
                    <h2>London</h2>
                    <p>London is the capital city of England.</p>
                </div>

                <div id="Paris" class="w3-container city" style="display:none">
                    <h2>Paris</h2>
                    <p>Paris is the capital of France.</p>
                </div>

                <div id="Tokyo" class="w3-container city" style="display:none">
                    <h2>Tokyo</h2>
                    <p>Tokyo is the capital of Japan.</p>
                </div>
                <script>
                function openCity(evt, cityName, color) {
                    var i, x, tablinks;
                    x = document.getElementsByClassName("city");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    blue = document.getElementById("blue");
                    green = document.getElementById("green");
                    red = document.getElementById("red");
                    if(color == "blue"){
                        blue.className = blue.className.replace(" w3-border-white", " w3-border-blue");
                        green.className = green.className.replace(" w3-border-green", " w3-border-white");
                        red.className = red.className.replace(" w3-border-red", " w3-border-white");
                    }
                    if(color == "green"){
                        blue.className = blue.className.replace(" w3-border-blue", " w3-border-white");
                        green.className = green.className.replace(" w3-border-white", " w3-border-green");
                        red.className = red.className.replace(" w3-border-red", " w3-border-white");
                    }
                    if(color == "red"){
                        blue.className = blue.className.replace(" w3-border-blue", " w3-border-white");
                        green.className = green.className.replace(" w3-border-green", " w3-border-white");
                        red.className = red.className.replace(" w3-border-white", " w3-border-red");
                    }

                    document.getElementById(cityName).style.display = "block";
                    //evt.currentTarget.firstElementChild.className += color;
                }
                </script>
            </div>

        </div>

        <!-- END Tabs estante de livros -->
        <!-- End Middle Column -->
    </div>
    <!-- END ROW -->
</div>

@endsection
