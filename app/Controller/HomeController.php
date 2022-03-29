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

            echo '<script>alert("Veículo inserido com sucesso!")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=index"</script>';
        } catch(Exception $e){
            echo '<script>alert("'.$e->getMessage().'")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=create"</script>';
        }
    }

    public function change($paramId){
        $loader = new \Twig\Loader\FilesystemLoader('app/View');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');
        
        $veic = Veiculos::selecionaPorId($paramId);

        $parametros = array();
        $parametros['id'] = $veic->id;
        $parametros['veiculo'] = $veic->veiculo;
        $parametros['marca'] = $veic->marca;
        $parametros['ano'] = $veic->ano;
        $parametros['descricao'] = $veic->descricao;
        $parametros['vendido'] = $veic->vendido;
        $parametros['created'] = $veic->created;

        $conteudo = $template->render($parametros);
        echo $conteudo;
        
    }

    public function update(){
        try{
            
            Veiculos::update($_POST);

            echo '<script>alert("Veículo alterado com sucesso!")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=index"</script>';
        } catch(Exception $e){
            echo '<script>alert("'.$e->getMessage().'")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=change&id='.$_POST['id'].'"</script>';
        }
    }

    public function delete($paramId){        
        
        
        try{
            
            Veiculos::delete($paramId);

            echo '<script>alert("Veículo deletado com sucesso!")</script>';
            echo '<script>location.href="http://localhost/processo_seletivo/relampago_sarinha/?pagina=home&metodo=index"</script>';
        } catch(Exception $e){
            echo '<script>alert("'.$e->getMessage().'")</script>';
        }
    }
}