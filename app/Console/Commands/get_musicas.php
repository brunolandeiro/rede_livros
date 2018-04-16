<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class get_musicas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_musicas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pega as musicas mais tocadas no site letras';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        //$info_livro = array('img'=>"https://cache.fluxo.info/data/9a/ee/9aeea7953314d2c0adc0745eceda38fa3593c143/acolhimentoemrede.org.br/site/wp-content/themes/acolhimento/images/icons/book.png",'desc'=>'Sem descrição');
        // $url = 'http://lelivros.cricket/categoria/'.$categoria.'/'.$page;
        $url_mais_acessadas = 'https://www.letras.mus.br/mais-acessadas/';
        $url = 'https://www.letras.mus.br';
        //Pega o conteudo da pagina
        $pagina_sitring = file_get_contents($url_mais_acessadas, false, stream_context_create($arrContextOptions));
        //Limpa as quebras de linha
        $pagina_sitring = preg_replace( "/\r|\n/", "", $pagina_sitring);
        //get primeiro item de lista
        $regex_ul = '/<ol class="top-list_mus cnt-list--col1-3">(.+?)<\/ol>/';
        preg_match($regex_ul, $pagina_sitring, $ul);
        //separa itens em uma array
        $regex_li = '/<li>(.+?)<\/li>/';
        preg_match_all($regex_li, $ul[1], $li);
        foreach($li[0] as $item){

            $regex_nome = '/<b>(.+?)<\/b>/';
            preg_match($regex_nome, $item, $nome);
            if(isset($nome[1])){
                $musica['nome'] = $nome[1];
            }
            else {
                $musica['nome'] = 'Erro - Sem nome';
            }

            $regex_cantor = '/<span>(.+?)<\/span>/';
            preg_match($regex_cantor, $item, $cantor);
            if(isset($cantor[1])){
                $musica['cantor'] = $cantor[1];
            }
            else {
                $musica['cantor'] = 'Erro - Sem cantor';
            }
            $regex_link = '/href="(.+?)"/';
            preg_match($regex_link, $item, $href);
            $musica['link'] = isset($href[1]) ? $href[1] : 'Erro - Sem link';

            if(isset($href[1])){
                $pagina_interna = file_get_contents($url.$href[1], false, stream_context_create($arrContextOptions));
                //Limpa as quebras de linha
                $pagina_interna = preg_replace( "/\r|\n/", "", $pagina_interna);
                //get descrição do livro
                $regex_head = '/<div class="cnt-head_title">(.+?)<\/a>/';
                preg_match($regex_head, $pagina_interna, $head);
                $regex_img = '/src="(.+?)"/';
                preg_match($regex_img, $head[1], $img);
                if(isset($img[1])){
                    $musica['img'] = $img[1];
                }else{
                    $musica['img'] = 'Erro - sem img';
                }

                $regex_letra = '/<article>(.+?)<\/article>/';
                preg_match($regex_letra, $pagina_interna, $letra);
                if(isset($letra[1])){
                    $musica['letra'] = html_entity_decode($letra[1]);
                }else{
                    $musica['letra'] = 'Erro - Sem letra';
                }

                $regex_youtube = '/"YoutubeID":"(.+?)"/';
                preg_match($regex_youtube, $pagina_interna, $tube);
                if(isset($tube[1])){
                    $musica['youtube'] = $tube[1];
                }else{
                    $musica['youtube'] = 'Erro - sem video';
                }
            }

            $ja_existe = \App\Musicas::where('nome',$musica['nome'])->first();
            if(!$ja_existe){
                \App\Musicas::create($musica);
            }
        }
    }
}
