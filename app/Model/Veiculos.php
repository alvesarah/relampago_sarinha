<?php

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

    public static function selecionaPorId($id){
        $con = Connection::getConn();

        $sql = "SELECT * FROM veiculos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultado = $sql->fetchObject('Veiculos');

        if(!$resultado){
            throw new Exception("Não foi encontrado nenhum registro no banco");
        }

        return $resultado;
    }
}