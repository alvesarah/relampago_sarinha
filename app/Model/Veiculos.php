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

    public static function insert($dadosPost){
        if(empty($dadosPost['veiculo']) || empty($dadosPost['marca']) || empty($dadosPost['ano'])){
            throw new Exception("Preencha todos os campos");

            return false;
        }

        var_dump($dadosPost);

        $con = Connection::getConn();

        $agora = date('Y-m-d H:i:s');
        $sql = $con->prepare("INSERT INTO `veiculos` (`id`, `veiculo`, `marca`, `ano`, `descricao`, `vendido`, `created`, `updated`) VALUES (NULL, :veic, :marca, :ano, :descricao, :vendido, '$agora', NULL)");
        $sql->bindValue(':veic', $dadosPost['veiculo']);
        $sql->bindValue(':marca', $dadosPost['marca']);
        $sql->bindValue(':ano', $dadosPost['ano']);
        $sql->bindValue(':descricao', $dadosPost['descricao']);
        $sql->bindValue(':vendido', $dadosPost['vendido']);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao inserir veiculo");

            return false;
        }

        return true;
    }
}