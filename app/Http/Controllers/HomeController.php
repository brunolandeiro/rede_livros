<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index()
    {
        $usuario = Auth::user();
        if($usuario->img_ativa){
            $img = \App\Img_perfil::where('id_img_perfil',$usuario->img_ativa)->first();
            $img_nome = $img->nome_img;
        }
        else{
            $img_nome = asset('/W3.CSS/avatar3.png');
        }
        return view('home',[],[
            'usuario'=>$usuario,
            'img'=> $img_nome
        ]);
    }

    /* Edita a foto de perfil e retorna para home */
    public function UpdatePerfil(Request $request){
        $usuario = Auth::user();

        $data['profissao'] = $request->profissao;
        $data['nascimento'] = $request->nascimento;

        $file = $request->file('img_perfil');
        if ($request->hasFile('img_perfil')) {
            if ($file->isValid()) {
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $caminho = $file->move('imgs_perfil/', $fileName);
                $nova_img = \App\Img_perfil::create([
                    'fk_user_id' => $usuario->id,
                    'nome_img' => $caminho
                ]);
                $data['img_ativa'] = $nova_img->id_img_perfil;
            }
        }

        \App\User::where('id', $usuario->id)->update($data);

        return redirect('home');
    }
}
