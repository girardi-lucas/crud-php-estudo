<?php
require_once 'functions.php';

$opcao = '';
$usuarios = [];

while ($opcao != '0') {
    echo "Escolha sua opção : \n";
    echo "1 - Cadastrar usuário \n";
    echo "2 - Listar usuários \n";
    echo "3 - Editar cadastro \n";
    echo "4 - Deletar cadastro \n";
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
            
        case '0':
            echo "Saindo do sistema... \n";
            break;
            



    }
}
