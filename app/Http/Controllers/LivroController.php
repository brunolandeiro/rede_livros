<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LivroController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($livro_id,$usuario_id){
        /* Get usuario do livro */
        $usuario = \App\User::where('id', $usuario_id)->first();
        if($usuario->img_ativa){
            $img = \App\Img_perfil::where('id_img_perfil',$usuario->img_ativa)->first();
            $img_nome = asset($img->nome_img);
        }
        else{
            $img_nome = asset('/W3.CSS/avatar3.png');
        }
        /* Get livro */
        $livro = \App\Livro::where('livro_id', $livro_id)->first();

        /* Verifica se o usuario logado é o dono do livro */
        $dono = $usuario == Auth::user();
        return view('livro',[],[
            'usuario'=>$usuario,
            'img'=> $img_nome,
            'livro' => $livro,
            'dono' => $dono
        ]);
    }
}
