<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    public function UpdatePerfil(Request $request){
        $usuario = Auth::user();
        $file = $request->file('img_perfil');
        if (!$request->hasFile('img_perfil')) {
            return redirect('/home')->with('warning', 'Nenhuma imagem enviada');
        }
        if ($file->isValid()) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $caminho = $file->move('public\imgs_perfil', $fileName);
            App\Img_perfil::create([
                'fk_user_id' => $usuario->id,
                'nome_img' => $caminho
            ]);
        }

    }
}
