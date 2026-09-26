<?php
require_once 'functions.php';

function cadastrarUsuario(&$usuarios){
    echo "Vamos começar o cadastro do usuário \n";
    $nome = solicitarEValidarNome();
    $email = solicitarEValidarEmail($usuarios);
    $telefone = solicitarEValidarTelefone();

    $usuarios[] = [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone
    ];
    echo "Usuário cadastrado com sucesso! \n";
}


function listarUsuarios($usuarios){
    if (empty($usuarios)){
        echo "Nenhum usuário cadastrado no momento !";
        return;
    }
    echo "Listando usuários cadastrados \n";
            echo "----------------------------- \n";
            foreach ($usuarios as $usuario) {
                echo "Nome: {$usuario['nome']} \n";
                echo "Email: {$usuario['email']} \n";
                echo "Telefone: {$usuario['telefone']} \n";
                echo "----------------------------- \n";
            }
}

function editarUsuario(&$usuarios){
    if (empty($usuarios)){
        echo "Nenhum usuário cadastrado no momento !";
        return;
    }
    foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoEditar = readline("Digite o número do cadastro que deseja editar: ");
            if (!isset($usuarios[$opcaoEditar - 1])) {
                echo "Opção inválida! Usuário não encontrado.\n";
                return;
            }

            $indiceAtual = $opcaoEditar - 1;
            $novoNome = solicitarEValidarNome();
            $usuarios[$indiceAtual]['nome'] = $novoNome;

            $novoEmail = solicitarEValidarEmail($usuarios, $indiceAtual);
            $usuarios[$indiceAtual]['email'] = $novoEmail;

            $novoTelefone = solicitarEValidarTelefone();
            $usuarios[$indiceAtual]['telefone'] = $novoTelefone;
            
          
            echo "Cadastro atualizado com sucesso! \n";
}

function deletarUsuario(&$usuarios){
     if (empty($usuarios)){
        echo "Nenhum usuário cadastrado no momento !";
        return;
    }
    foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoDeletar = readline("Digite o número do cadastro que deseja deletar: ");
            $indiceReal =  $opcaoDeletar - 1;
            
        if (isset($usuarios[$indiceReal])) {
            array_splice($usuarios, $indiceReal, 1);
            echo "Usuário deletado com sucesso!\n";
        }  else {
        echo "Opção inválida! Usuário não encontrado.\n";
        }
            
}

function buscarUsuarios($usuarios, $termoBusca) {
    $usuariosEncontrados = [];
    foreach ($usuarios as $indice => $usuario) {
        if (stripos($usuario['nome'], $termoBusca) !== false) {
            $usuariosEncontrados[$indice] = $usuario;
        }

    }
    return $usuariosEncontrados;
}