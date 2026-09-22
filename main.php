<?php

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
            echo "Vamos começar o cadastro do usuário \n";
            $nome = readline("Digite o nome do usuário: ");

            do{
                $email = readline("Digite o email do usuário: ");
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "Email inválido. Digite um email válido. \n";
                }
            } while (!filter_var($email, FILTER_VALIDATE_EMAIL));

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
            break;
        case '2':
            echo "Listando usuários cadastrados \n";
            echo "----------------------------- \n";
            foreach ($usuarios as $usuario) {
                echo "Nome: {$usuario['nome']} \n";
                echo "Email: {$usuario['email']} \n";
                echo "Telefone: {$usuario['telefone']} \n";
                echo "----------------------------- \n";
            }
            break;
        case '3':
            foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoEditar = readline("Digite o número do cadastro que deseja editar: ");

            $usuarios[$opcaoEditar - 1]['nome'] = readline("Digite o novo nome do usuário: ");

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
            break;
        case '4':
            foreach ($usuarios as $indice => $usuario) {
                $posicao = $indice + 1;
                echo "[$posicao] Nome: {$usuario['nome']} \n";
            }
            $opcaoDeletar = readline("Digite o número do cadastro que deseja deletar: ");
            unset($usuarios[$opcaoDeletar - 1]);
            echo "Cadastro deletado com sucesso! \n";
            break;
        case '0':
            echo "Saindo do sistema... \n";
            break;
            



    }
}
