<?php

class DetalhesController{
    public function index($params){
        try{
            $detalhes = Veiculos::selecionaPorId($params);
            
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
			$twig = new \Twig\Environment($loader);
            $template = $twig->load('detalhes.html');

            $parametros = array();
            $parametros['nome'] = $detalhes->veiculo;
            $parametros['marca'] = $detalhes->ano;
            $parametros['ano'] = $detalhes->marca;
            $parametros['descricao'] = $detalhes->descricao;

            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch(Exception $e){
            // Imprimir mensagem de erro se não houver registro
            echo $e->getMessage();
        }
    }
}