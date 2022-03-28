<?php

// Conectar com o banco de dados e trazer os dados
class Veiculos{
    public static function selecionarTodos(){
        $con = Connection::getConn();

        $sql = "SELECT * FROM veiculos ORDER BY id DESC";
        
        // Executar/preparar a execução do sql
        $sql = $con->prepare($sql);
        $sql->execute();

        $resultado = array();
        
        // Pegar um registo do banco e converter em objeto
        while($row = $sql->fetchObject('Veiculos')){
            // Armazenar resultado(registros) no array
            $resultado[] = $row;
        }

        // Se não encontrar nenhum registro
        if(!$resultado){
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }

        return $resultado;
    }
}