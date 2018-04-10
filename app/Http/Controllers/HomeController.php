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
    public function index($perfil_id = null)
    {
        if($perfil_id){
            $usuario = \App\User::where('id', $perfil_id)->first();
            $dono = false;
        }else{
            $usuario = Auth::user();
            $dono = true;
        }

        if($usuario->img_ativa){
            $img = \App\Img_perfil::where('id_img_perfil',$usuario->img_ativa)->first();
            $img_nome = asset($img->nome_img);
        }
        else{
            $img_nome = asset('/W3.CSS/default-avatar.jpg');
        }
        $livros = \App\Livro::where("user_fk", $usuario->id)->orderBy('livro_id', 'desc')->get();
        $lelivros = \App\Lelivros::all();
        return view('home',[],[
            'usuario'=>$usuario,
            'img'=> $img_nome,
            'livros' => $livros,
            'dono' => $dono,
            'perfil_id' => $perfil_id,
            'lelivros' => $lelivros
        ]);
    }

    /* Edita a foto de perfil e retorna para home */
    public function UpdatePerfil(Request $request){
        $usuario = Auth::user();

        // $data['profissao'] = $request->profissao;
        // $data['nascimento'] = $request->nascimento;
        $validator = Validator::make($request->all(),
        ['img_perfil' => 'image',],
        ['img_perfil.image' => 'O arquivo deve ser uma imagem.']);
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }
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

        return redirect('/');
    }

    public function AddLivro(Request $request){
        $validator = Validator::make($request->all(),
        [
            'titulo' => 'required|max:200',
            'autor' => 'max:100'
        ],mensagens_de_erro('Livro'));
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }
        $usuario = Auth::user();
        $data['user_fk'] = $usuario->id;
        $data['titulo'] = $request->titulo;
        $data['autor'] = $request->autor;
        $info_livro = $this->BuscaInfoLivro($request->titulo, $request->autor);
        $data['img'] = $info_livro['img'];
        $data['descricao'] = $info_livro['desc'];

        \App\Livro::create($data);
        return redirect('/')->with('alerta','O seu livro não é esse?? É só clicar no livro é editar as informações.');
    }

    //Busca uma imagem a partir do titulo de um livro
    private function BuscaInfoLivro($titulo, $autor){
        $info_livro = array('img'=>"https://cache.fluxo.info/data/9a/ee/9aeea7953314d2c0adc0745eceda38fa3593c143/acolhimentoemrede.org.br/site/wp-content/themes/acolhimento/images/icons/book.png",'desc'=>'Sem descrição');
        $titulo = str_replace(" ", "+", $titulo);
        $autor = str_replace(" ", "+", $autor);
        $url = 'http://lelivros.love/?x=0&y=0&s='.$titulo;

        //Pega o conteudo da pagina
        $pagina_sitring = file_get_contents($url);

        //Limpa as quebras de linha
        $pagina_sitring = preg_replace( "/\r|\n/", "", $pagina_sitring);

        //get primeiro item de lista
        $regex = '/<li class="post-17105 product type-product status-publish has-post-thumbnail hentry first instock">(.+?)<\/li>/';
        preg_match($regex, $pagina_sitring, $primeiro_item_da_lista);

        //get link para a imagem do primeiro link
        if(count($primeiro_item_da_lista) > 1){
            //Pega o src da img
            $regex_img = '/src="(.+?)"/';
            preg_match($regex_img, $primeiro_item_da_lista[1], $src);

            //Pega href da pagina interna do livro
            $regex_url_interno = '/href="(.+?)"/';
            preg_match($regex_url_interno, $primeiro_item_da_lista[1], $url_interno);
            //Conteudo da pagina interna do livro
            $pagina_interna_livro = file_get_contents($url_interno[1]);
            //Limpa as quebras de linha
            $pagina_interna_livro = preg_replace( "/\r|\n/", "", $pagina_interna_livro);

            //get descrição do livro
            $regex_descricao_completo = '/<div class="panel entry-content" id="tab-description" style="display: block;">(.+?)<\/div>/';
            preg_match($regex_descricao_completo, $pagina_interna_livro, $descricao);
            $descricao[1] = str_replace("<h2>Descrição do livro</h2>","",$descricao[1]);
            $info_livro['desc'] = html_entity_decode($descricao[1]);
            $info_livro['img'] = $src[1];
        }

        return $info_livro;
    }

    public function trocaEstante(Request $request){
        $msg_erro = 'Estamos com problemas para realizar a operação. Tente novamente mais tarde.';
        $validator = Validator::make($request->all(), [
            'estante' => 'required|numeric|max:4|min:1',
            'livro_id' => 'required|numeric|min:1'
        ], mensagens_de_erro('trocaEstante'));
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        }
        $data['estante'] = $request->estante;
        $id = $request->livro_id;
        \App\Livro::where('livro_id', $request->livro_id)->update($data);
        return redirect('/')->with('estante_atual', $request->estante);
    }
}
