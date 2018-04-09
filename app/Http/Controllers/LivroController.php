<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
            $img_nome = asset('/W3.CSS/default-avatar.jpg');
        }
        /* Get livro */
        $livro = \App\Livro::where('livro_id', $livro_id)->first();

        /* Verifica se o usuario logado é o dono do livro */
        $dono = $usuario == Auth::user();
        return view('livro.livro',[],[
            'usuario'=>$usuario,
            'img'=> $img_nome,
            'livro' => $livro,
            'dono' => $dono,
            'perfil_id' => $usuario_id
        ]);
    }

    public function editLivro($livro_id){
        $livro = \App\Livro::where('livro_id', $livro_id)->first();
        if(!$livro){
            return redirect()->action('HomeController@index')->with('erro','Não encontramos a página requisitada!');
        }
        $usuario = $livro->usuario;
        if($usuario != Auth::user()){
            return redirect()->action('HomeController@index')->with('erro','Você não tem acesso a esse livro');
        }
        $img_nome = GetAvatarUsuario($usuario);

        return view('livro.editLivro',[],[
            'livro'=>$livro,
            'usuario'=>$usuario,
            'img'=> $img_nome,
            'dono' => true,
            'perfil_id' => $usuario->id
        ]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),
        [
            'img_livro' => 'image',
            'titulo' => 'required|max:200',
            'autor' => 'max:100',
            'descricao' => 'max:2000',
        ],mensagens_de_erro('Livro'));

        $teste= $request->livro_id;
        if ($validator->fails()) {
            $url = '/livro/editar/'.$request->livro_id;
            return redirect($url)->withErrors($validator)->withInput();
        }

        $data['titulo'] = $request->titulo;
        $data['autor'] = $request->autor;
        $data['descricao'] = $request->descricao;
        \App\Livro::where('livro_id',$request->livro_id)->update($data);
        $redirect = '/livro/mostrar/'.$request->livro_id.'/'.Auth::user()->id;
        return redirect($redirect)->with('success','Livro alterado com sucesso!');
    }
}
