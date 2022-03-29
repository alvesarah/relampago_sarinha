<?php
 
# É necessário criar um database no phpMyAdmin rodando o comando abaixo
// CREATE DATABASE relampago_sarinha;

# Conexão com o banco de dados MySQL (login: root e sem senha) *****************************************
$servidor = "localhost";
$usuario = "root";
$senha = "";
$database = "relampago_sarinha";
 
$conexao = mysqli_connect($servidor, $usuario, $senha, $database);
 

// Também é possivel criar direto pelo phpMyAdmin
# Criando tabelas ************************************************
# Tabela veiculos (veiculo, marca, ano, descricao, vendido, created, updated)
$query = "CREATE TABLE VEICULOS(
	id int not null auto_increment,
	veiculo varchar(255) not null,
	marca varchar(255) not null,
    ano int not null,
    descricao text,
    vendido TINYINT(1) not null,
    created datetime not null,
    updated datetime,
	primary key(id)
)";
 
$executar = mysqli_query($conexao, $query);