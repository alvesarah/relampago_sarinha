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

    public function create(){        
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        $parametros = array();

        $conteudo = $template->render($parametros);
        echo $conteudo;
    }

    public function insert(){

        try{
            Veiculos::insert($_POST);

            echo '<script>alert("Publicação inserida com sucesso!")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=index"</script>';
        } catch(Exception $e){
            echo '<script>alert("'.$e->getMessage().'")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=create"</script>';
        }
    }
}