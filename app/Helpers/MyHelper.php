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

if (!function_exists('mensagens_de_erro')){
    function mensagens_de_erro($tipo){
        switch ($tipo){
            case 'Livro':
                $mensagem = array(
                    'img_livro.image' => 'O arquivo deve ser uma imagem.',
                    'titulo.required' => 'O campo título é obrigatório',
                    'titulo.max' => 'O campo título deve ter no máximo :max caracteres.',
                    'autor.max' => 'O campo Autor deve ter no máximo :max caracteres.',
                    'descricao.max' => 'O campo Descrição deve ter no máximo :max caracteres.'
                );
                break;
            case 'trocaEstante':
                $msg_erro = 'Estamos com problemas para realizar a operação. Tente novamente mais tarde.';
                $mensagem = array(
                    'estante.required' => $msg_erro,
                    'estante.max' => $msg_erro,
                    'estante.min' => $msg_erro,
                    'livro_id.required' => $msg_erro,
                    'livro_id.min' => $msg_erro
                );
                break;
            default:
                $mensagem = array();
        }
        return $mensagem;
    }
}
