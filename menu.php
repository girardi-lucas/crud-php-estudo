<?php
require_once 'functions.php';
require_once 'validations.php';

// "&" permite que a função modifique o array original, e não uma cópia dele. Isso é útil quando queremos alterar o conteúdo do array dentro da função e refletir essas alterações fora dela.
function abrirMenu(&$usuarios){
    $opcao = '';
    while ($opcao != '0') {
        echo "Escolha sua opção : \n";
        echo "1 - Cadastrar usuário \n";
        echo "2 - Listar usuários \n";
        echo "3 - Editar cadastro \n";
        echo "4 - Deletar cadastro \n";
        echo "5 - Buscar usuário \n";
        echo "0 - Sair \n";

        $opcao = readline("Digite a opção desejada: ");

        switch ($opcao) {
            case '1':
                cadastrarUsuario($usuarios);
                break;

            case '2':
                listarUsuarios($usuarios);
                break;

            case '3':
                editarUsuario($usuarios);
                break;

            case '4':
                deletarUsuario($usuarios);
                break;
            
            case '5':
                $termoBusca = readline("Digite o nome do usuário que deseja buscar: ");
                if (empty($termoBusca)) {
                    echo "Nenhum termo de busca informado. \n";
                    break;
                }
                $usuariosEncontrados = buscarUsuarios($usuarios, $termoBusca);
                if (empty($usuariosEncontrados)) {
                    echo "Nenhum usuário encontrado com o termo de busca informado. \n";
                    break;
                }
                echo "Usuários encontrados: \n";
                echo "----------------------------- \n";
                listarUsuarios($usuariosEncontrados);
                break;
            case '0':

                echo "Saindo do sistema... \n";
                break;

            default:
                echo "Opção inválida. Digite uma opção válida. \n";
        }
    }
}