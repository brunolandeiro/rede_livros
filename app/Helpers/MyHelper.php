<?php

if (!function_exists('DummyFunction')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function DummyFunction()
    {

    }
}

if (!function_exists('GetAvatarUsuario')){
    function GetAvatarUsuario($usuario){
        if($usuario->img_ativa){
            $img = \App\Img_perfil::where('id_img_perfil',$usuario->img_ativa)->first();
            $img_nome = asset($img->nome_img);
        }
        else{
            $img_nome = asset('/W3.CSS/default-avatar.jpg');
        }
        return $img_nome;
    }
}
