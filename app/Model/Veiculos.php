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
            throw new Exception("Falha ao inserir veículo");

            return false;
        }

        return true;
    }

    public static function update($params){
        $con = Connection::getConn();

        $agora = date('Y-m-d H:i:s');

        $sql = "UPDATE veiculos SET veiculo = :veic, marca = :marca, ano = :ano, descricao = :descricao, vendido = :vendido, updated = '$agora' WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':veic', $params['veiculo']);
        $sql->bindValue(':marca', $params['marca']);
        $sql->bindValue(':ano', $params['ano']);
        $sql->bindValue(':descricao', $params['descricao']);
        $sql->bindValue(':vendido', $params['vendido']);
        $sql->bindValue(':id', $params['id']);

        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao alterar veículo");

            return false;
        }

        return true;
    }

    public static function delete($id){
        $con = Connection::getConn();
        $sql = "DELETE FROM veiculos WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);

        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao deletar veículo");

            return false;
        }

        return true;
    }
}