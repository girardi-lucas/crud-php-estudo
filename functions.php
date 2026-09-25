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
    try {
    $dadosJson = json_encode($usuarios, JSON_THROW_ON_ERROR);
    file_put_contents('dados.json', $dadosJson);
    } catch (JsonException $erro){
        echo "Erro na hora de salvar o arquivo, tente novamente!";


    }
}

function lerJson () {
    if (file_exists('dados.json') === true) {
        try {
        $dadosEmArray = file_get_contents('dados.json');
        $dadosTraduzidos = json_decode($dadosEmArray, true, 512, JSON_THROW_ON_ERROR);
        return $dadosTraduzidos;
        } catch (JsonException $erro){
            echo "Arquivo corrompido, gerando novo arquivo json.";
            return [];
        }
    } else {
        return [];
    }
}

// Função para solicitar e validar o nome do usuário
function solicitarEValidarNome() {
    do {
        $nome = readline("Digite o nome do usuário: ");
        if (empty($nome)) {
            echo "Nome inválido. Digite um nome válido. \n";
        } else if (strlen($nome) < 3) {
            echo "Nome muito curto. Digite um nome com pelo menos 3 caracteres. \n";
        } else if (ctype_alpha(str_replace(' ', '', $nome)) === false) { // Permitir espaços no nome
            echo "Nome inválido. Digite apenas letras. \n";
        }
    } while (empty($nome) || strlen($nome) < 3 || ctype_alpha(str_replace(' ', '', $nome)) === false);
    
    return $nome;
}

// Função para solicitar e validar o telefone do usuário
function solicitarEValidarTelefone() {
    do {
        $telefone = readline("Digite o telefone do usuário: ");
        if (!is_numeric($telefone)) {
            echo "Telefone inválido. Digite apenas números. \n";
        }
    } while (!is_numeric($telefone));
    
    
    return $telefone;
}


// Função para solicitar e validar o email do usuário
function solicitarEValidarEmail($usuarios, $indiceAtual = null) {
    do {
        $email = readline("Digite o email do usuário: ");
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido. Digite um email válido. \n";
        } else {
        $emailRepetido = false;
        foreach ($usuarios as $indice => $usuario) {
            if ($usuario['email'] === $email && $indice !== $indiceAtual) {
                echo "Esse email já foi cadastrado, por favor cadastre um novo email !\n";
                $emailRepetido = true;
                break;
                }
            }
        }
    } while (!filter_var($email, FILTER_VALIDATE_EMAIL) || $emailRepetido);
    
    return $email;
}