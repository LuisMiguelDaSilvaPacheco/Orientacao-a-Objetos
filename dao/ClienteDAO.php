<?php

require_once("modelo/Cliente.php");
require_once("modelo/ClientePF.php");
require_once("modelo/ClientePJ.php");
require_once("util/Conexao.php");

//DAO significa: Data Access Object

class ClienteDAO {

    public function inserir(Cliente $cliente) {
        //TODO - Persistir o objeto $cliente no banco de dados

        $sql = "INSERT INTO clientes
        (tipo,
        nomeSocial,
        email,
        nomeCompleto,
        cpf,
        razaoSocial,
        cnpj) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $conexao = Conexao::getConexao();
        $stm = $conexao->prepare($sql);
        if ($cliente instanceof ClientePF) {
                $stm->execute(array(
                $cliente->getTipo(),
                $cliente->getNomeSocial(),
                $cliente->getEmail(),
                $cliente->getNomeCompleto(),
                $cliente->getCpf(),
                NULL,
                NULL
            ));
        }
        
    }

    public function listar(){
        $sql = "SELECT * FROM clientes";

        $conexao = Conexao::getConexao();
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();

        return $dados;
    }

}
