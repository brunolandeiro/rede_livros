<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class get_livros extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_livros';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pega livros de site lelivros!';

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
        $categorias = array(
            "poesia",
            "policial",
            "psicologia"
        );
        $numero_de_paginas = 3;
        foreach($categorias as $categoria){

            for($i=0;$i<3;$i++){
                if($i==0){
                    $page="";
                }else{
                    $page='page/'.$i.'/';
                }
                //$info_livro = array('img'=>"https://cache.fluxo.info/data/9a/ee/9aeea7953314d2c0adc0745eceda38fa3593c143/acolhimentoemrede.org.br/site/wp-content/themes/acolhimento/images/icons/book.png",'desc'=>'Sem descrição');
                $url = 'http://lelivros.cricket/categoria/'.$categoria.'/'.$page;
                //Pega o conteudo da pagina
                $pagina_sitring = file_get_contents($url);
                //Limpa as quebras de linha
                $pagina_sitring = preg_replace( "/\r|\n/", "", $pagina_sitring);

                //get primeiro item de lista
                $regex_ul = '/<ul class="products">(.+?)<\/ul>/';
                preg_match($regex_ul, $pagina_sitring, $ul);
                //separa itens em uma array
                $regex_li = '/<li class=(.+?)<\/li>/';
                preg_match_all($regex_li, $ul[1], $li);
                //var_dump($li);

                foreach($li[0] as $item){
                    //Pega o src da img
                    $regex_img = '/src="(.+?)"/';
                    preg_match($regex_img, $item, $src);
                    $livro['img'] = $src[1];
                    //Pega o nome/autor do livro
                    $regex_nome = '/<h3>(.+?)<\/h3>/';
                    preg_match($regex_nome, $item, $nome);
                    $livro['titulo'] = str_replace("&#8211;","–",$nome[1]);
                    // $nome_e_autor = explode(" – ",$nome[1]);
                    // $livro['autor'] = $nome_e_autor[count($nome_e_autor)-1];

                    // Pega href da pagina interna do livro
                    $regex_url_interno = '/href="(.+?)"/';
                    preg_match($regex_url_interno, $item, $url_interno);
                    //Conteudo da pagina interna do livro
                    $pagina_interna_livro = file_get_contents($url_interno[1]);
                    //Limpa as quebras de linha
                    $pagina_interna_livro = preg_replace( "/\r|\n/", "", $pagina_interna_livro);

                    //get descrição do livro
                    $regex_descricao_completo = '/<div class="panel entry-content" id="tab-description" style="display: block;">(.+?)<\/div>/';
                    preg_match($regex_descricao_completo, $pagina_interna_livro, $descricao);
                    $descricao[1] = str_replace("<h2>Descrição do livro</h2>","",$descricao[1]);
                    $livro['descricao'] = html_entity_decode($descricao[1]);

                    $ja_existe = \App\Lelivros::where('titulo',$livro['titulo'])->first();
                    if(!$ja_existe){
                        \App\Lelivros::create($livro);
                    }
                }

            }

        }
    }
}
