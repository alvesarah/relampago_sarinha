<?php

class HomeController{
    public function index(){
        try{
            $colecaoVeiculos = Veiculos::selecionarTodos();
            
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parametros = array();
            $parametros['veiculos'] = $colecaoVeiculos;

            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch(Exception $e){
            // Imprimir mensagem de erro se não houver registro
            echo $e->getMessage();
        }
    }
}