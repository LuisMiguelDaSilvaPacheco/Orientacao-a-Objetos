<?php


/*//Testar a conexão com o banco de dados
require_once("util/Conexao.php");

$conexao = Conexao::getConexao();
print_r($conexao);*/


require_once("modelo/ClientePF.php");
require_once("dao/ClienteDAO.php");

$clienteDAO = new ClienteDAO();

do {
    printM("\n\n
        *************************************
        *        CADASTRO DE CLIENTES       *
        *************************************
        * 1- Inserir Cliente PF             *
        * 2- Inserir Cliente PJ             *
        * 3- Listar Clientes                *
        * 4- Buscar Cliente                 *
        * 5- Excluir Cliente                *
        *************************************
        * 0- Sair                           *
        *************************************\n", 1);
    $opcao = readline();

    switch($opcao) {
        case 1:
            //Inserir
            $clientePF = new ClientePF();
            $clientePF->setNomeCompleto(readline("Informe o nome completo: "));
            $clientePF->setNomeSocial(readline("Informe o nome social: "));
            $clientePF->setCpf(readline("Informe o CPF: "));
            $clientePF->setEmail(readline("Informe o e-mail: "));

            $clienteDAO->inserir($clientePF);
            break;

        case 2:
            //Inserir
            $clientePJ = new ClientePJ();
            $clientePJ->setRazaoSocial(readline("Informe a razão social: "));
            $clientePJ->setNomeSocial(readline("Informe o nome social: "));
            $clientePJ->setCnpj(readline("Informe o CNPJ: "));
            $clientePJ->setEmail(readline("Informe o e-mail: "));

            $clienteDAO->inserir($clientePJ);
            break;

        case 3:
            //Listar
            $clientes = $clienteDAO->listar();
            foreach ($clientes as $c) {
                printM($c. "\n", 5);
            }
            sleep(4);
            break;

        case 0:
            printM("Programa encerrado!\n", 50);
            break;

        default:
            printM("Opção inválida!\n", 50);

    }


} while($opcao != 0);

function printM(string $texto, int $velocidade){
    for ($i=0; $i < mb_strlen($texto, 'UTF-8'); $i++) { 
        print mb_substr($texto, $i, 1, "UTF-8");
        usleep($velocidade * 1000);
    }
}
