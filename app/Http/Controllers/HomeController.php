<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
        $livros = \App\Livro::where("user_fk", $usuario->id)->orderBy('livro_id', 'desc')->get();
        return view('home',[],[
            'usuario'=>$usuario,
            'img'=> $img_nome,
            'livros' => $livros
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

    public function AddLivro(Request $request){
        $validator = Validator::make($request->all(), ['titulo' => 'required'], ['titulo.required' => 'O campo Título é obrigatório.']);
        if ($validator->fails()) {
            return redirect('home')->withErrors($validator)->withInput();
        }
        $usuario = Auth::user();
        $data['user_fk'] = $usuario->id;
        $data['titulo'] = $request->titulo;
        $data['autor'] = $request->autor;
        $img = $this->BuscaImg($request->titulo, $request->autor);
        if(count($img) > 1){
            $data['img'] = $img['1'];
        }else{
            $data['img'] = "https://cache.fluxo.info/data/9a/ee/9aeea7953314d2c0adc0745eceda38fa3593c143/acolhimentoemrede.org.br/site/wp-content/themes/acolhimento/images/icons/book.png";
        }
        \App\Livro::create($data);
        return redirect('home');
    }

    //Busca uma imagem a partir do titulo de um livro
    private function BuscaImg($titulo, $autor){
        $titulo = str_replace(" ", "+", $titulo);
        $autor = str_replace(" ", "+", $autor);
        $url = 'http://lelivros.love/?x=0&y=0&s='.$titulo.'+'.$autor;
        //Pega o conteudo da pagina
        $pagina_sitring = file_get_contents($url);

        //Limpa as quebras de linha
        $pagina_sitring = preg_replace( "/\r|\n/", "", $pagina_sitring);

        //get primeiro item de lista
        $regex = '/<li class="post-17105 product type-product status-publish has-post-thumbnail hentry first instock">(.+?)<\/li>/';
        preg_match($regex, $pagina_sitring, $matches);

        //get link para a imagem do primeiro link
        if(count($matches) > 1){
            $regex = '/src="(.+?)"/';
            preg_match($regex, $matches[1], $src);
        }else{
            $src = null;
        }

        return $src;
    }

    public function trocaEstante(Request $request){
        $msg_erro = 'Estamos com problemas para realizar a operação. Tente novamente mais tarde.';
        $validator = Validator::make($request->all(), [
            'estante' => 'required|numeric|max:3|min:1',
            'livro_id' => 'required|numeric|min:1'
        ], [
            'estante.required' => $msg_erro,
            'estante.max' => $msg_erro,
            'estante.min' => $msg_erro,
            'livro_id.required' => $msg_erro,
            'livro_id.min' => $msg_erro
        ]);
        if ($validator->fails()) {
            return redirect('home')->withErrors($validator)->withInput();
        }
        $data['estante'] = $request->estante;
        $id = $request->livro_id;
        \App\Livro::where('livro_id', $request->livro_id)->update($data);
        return redirect('home')->with('estante_atual', $request->estante);
    }
}
