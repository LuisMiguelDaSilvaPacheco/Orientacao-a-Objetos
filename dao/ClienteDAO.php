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
        if($cliente instanceof ClientePF) {
            $stm->execute(array(
                $cliente->getTipo(),
                $cliente->getNomeSocial(),
                $cliente->getEmail(),
                $cliente->getNomeCompleto(),
                $cliente->getCpf(),
                NULL,
                NULL
            ));
        }elseif($cliente instanceof ClientePJ) {
            $stm->execute(array(
                $cliente->getTipo(),
                $cliente->getNomeSocial(),
                $cliente->getEmail(),
                NULL,
                NULL,
                $cliente->getRazaoSocial(),
                $cliente->getCnpj()
            ));
        }
        
    }

    public function listar(){
        $sql = "SELECT * FROM clientes";

        $conexao = Conexao::getConexao();
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $dados = $stm->fetchAll();

        $clientes = $this->mapear($dados);
        return $clientes;
    }

    private function mapear(array $dados): array{
        $clientes = array();
        foreach ($dados as $d) {
            $tipo = $d['tipo'];
            $cliente = null;
            if ($tipo = 'F') {
                $cliente = new ClientePF();
                $cliente->setNomeCompleto($d['nomeCompleto']);
                $cliente->setCpf($d['cpf']);
            }elseif($tipo = 'J'){
                $cliente = new ClientePJ();
                $cliente->setRazaoSocial($d['razaoSocial']);
                $cliente->setCnpj($d['cnpj']);
            }else{
                continue;
            }

            $cliente->setId($d['id']);
            $cliente->setNomeSocial($d['nomeSocial']);
            $cliente->setEmail($d['email']);

            array_push($clientes, $cliente);
        }
        return $clientes;
    }

}
