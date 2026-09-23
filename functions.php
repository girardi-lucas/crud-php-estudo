<?php

// "&" permite que a função modifique o array original, e não uma cópia dele. Isso é útil quando queremos alterar o conteúdo do array dentro da função e refletir essas alterações fora dela.
function abrirMenu(&$usuarios){
    $opcao = '';
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

            default:
                echo "Opção inválida. Digite uma opção válida. \n";
        }
    }
}


function cadastrarUsuario(&$usuarios){
    echo "Vamos começar o cadastro do usuário \n";
    do{
        $nome = readline("Digite o nome do usuário: ");
        if(empty($nome)){
            echo "Nome inválido. Digite um nome válido. \n";
        } else if(strlen($nome) < 3){
            echo "Nome muito curto. Digite um nome com pelo menos 3 caracteres. \n";
        } else if(ctype_alpha($nome) === false){
            echo "Nome inválido. Digite apenas letras. \n";
        }
    } while (empty($nome) || strlen($nome) < 3 || ctype_alpha($nome) === false);

    do{
        $email = readline("Digite o email do usuário: ");
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Email inválido. Digite um email válido. \n";
        }
        $emailRepetido = false;
        foreach ($usuarios as $usuario) {
            if ($usuario['email'] === $email){
                echo "Esse email já foi cadastrado, por favor cadastre um novo email !";
                $emailRepetido = true;
            }

        }
    } while (!filter_var($email, FILTER_VALIDATE_EMAIL) || $emailRepetido === true);

    do{
        $telefone = readline("Digite o telefone do usuário: ");
        if(!is_numeric($telefone)){
            echo "Telefone inválido. Digite apenas números. \n";
        }
    } while (!is_numeric($telefone));

    $usuarios[] = [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone
    ];
    echo "Usuário cadastrado com sucesso! \n";
}


function listarUsuarios($usuarios){
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
    foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoEditar = readline("Digite o número do cadastro que deseja editar: ");

            do{
                $usuarios[$opcaoEditar - 1]['nome'] = readline("Digite o novo nome do usuário: ");
                if(empty($usuarios[$opcaoEditar - 1]['nome'])){
                    echo "Nome inválido. Digite um nome válido. \n";
                } else if(strlen($usuarios[$opcaoEditar - 1]['nome']) < 3){
                    echo "Nome muito curto. Digite um nome com pelo menos 3 caracteres. \n";
                } else if(ctype_alpha($usuarios[$opcaoEditar - 1]['nome']) === false){
                    echo "Nome inválido. Digite apenas letras. \n";
                }
            } while (empty($usuarios[$opcaoEditar - 1]['nome']) || strlen($usuarios[$opcaoEditar - 1]['nome']) < 3 || ctype_alpha($usuarios[$opcaoEditar - 1]['nome']) === false);

            do{
                $usuarios[$opcaoEditar - 1]['email'] = readline("Digite o novo email do usuário: ");
                if(!filter_var($usuarios[$opcaoEditar - 1]['email'], FILTER_VALIDATE_EMAIL)){
                    echo "Email inválido. Digite um email válido. \n";
                }
            } while (!filter_var($usuarios[$opcaoEditar - 1]['email'], FILTER_VALIDATE_EMAIL));
            
            do{
                $usuarios[$opcaoEditar - 1]['telefone'] = readline("Digite o novo telefone do usuário: ");
                if(!is_numeric($usuarios[$opcaoEditar - 1]['telefone'])){
                    echo "Telefone inválido. Digite apenas números. \n";
                }
            } while (!is_numeric($usuarios[$opcaoEditar - 1]['telefone']));

            echo "Cadastro atualizado com sucesso! \n";
}

function deletarUsuario(&$usuarios){
    foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoDeletar = readline("Digite o número do cadastro que deseja deletar: ");

            unset($usuarios[$opcaoDeletar - 1]);
            $usuarios = array_values($usuarios); // Reindexa o array após a exclusão
            echo "Cadastro deletado com sucesso! \n";
}

function salvarJson ($usuarios) {
    $dadosJson = json_encode($usuarios);
    file_put_contents('dados.json', $dadosJson);
}

function lerJson () {
    if (file_exists('dados.json') === true) {
        $dadosEmArray = file_get_contents('dados.json');
        $dadosTraduzidos = json_decode($dadosEmArray, true);
        return $dadosTraduzidos;
    } else {
        return [];
    }
}