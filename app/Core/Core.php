<?php

class Core{
    public function start($urlGet){
        
        // Função no Controller
        if(isset($urlGet['metodo'])){
            $acao= $urlGet['metodo'];
        }else{
            $acao = 'index';
        }

        // Se existir 'pagina' na URL, aparece a requisição do GET
        if(isset($urlGet['pagina'])){
            // Chamar o controller que a página está chamando
            $controller = ucfirst($urlGet['pagina'].'Controller');
        } else {
            // Se não o padrão vai ser 'Home'
            $controller = 'HomeController';
        }
        
        // Se der erro, exibe a página de erro
        if(!class_exists($controller)){
            $controller = 'ErroController';
        }
        
        if(isset($urlGet['id']) && $urlGet['id'] != null){
            $id = $urlGet['id'];
        } else {
            $id = null;
        }

        // Exibir o conteudo da HomeController
        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
}