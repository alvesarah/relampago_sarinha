<?php

class HomeController{
    public function index(){
        try{
            $colecaoVeiculos = Veiculos::selecionarTodos();
            var_dump($colecaoVeiculos);
        } catch(Exception $e){
            // Imprimir mensagem de erro se não houver registro
            echo $e->getMessage();
        }
    }
}