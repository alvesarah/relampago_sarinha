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
            $parametros['marca'] = $detalhes->marca;
            $parametros['ano'] = $detalhes->ano;
            $parametros['descricao'] = $detalhes->descricao;
            $parametros['vendido'] = $detalhes->vendido;
            $parametros['created'] = $detalhes->created;
            $parametros['updated'] = $detalhes->updated;

            $conteudo = $template->render($parametros);
            echo $conteudo;

        } catch(Exception $e){
            // Imprimir mensagem de erro se não houver registro
            echo $e->getMessage();
        }
    }
}