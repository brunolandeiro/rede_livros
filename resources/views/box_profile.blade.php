<div class="w3-card w3-round w3-white">
    <div class="w3-container">
        <p class="w3-center">{{ $usuario->name }}</p>
        <p class="w3-center">
            <a href="#">
                <img src="{{$img}}" class="w3-circle img_perfil" style="height:106px;width:106px" alt="Avatar">
            </a>
        </p>
        <hr>
        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-text-theme"></i>{{$usuario->profissao}}</p>
        <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>{{date('d/m/Y', strtotime($usuario->nascimento))}}</p>

    </div>
</div>
<br>
