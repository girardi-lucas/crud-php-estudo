<?php

// Função para solicitar e validar o nome do usuário
function solicitarEValidarNome() {
    do {
        $nome = readline("Digite o nome do usuário: ");
        $nomeValido = preg_match('/^[a-zA-ZÀ-ÿ\s]+$/u', $nome); // Permitir letras acentuadas e espaços
        if (empty($nome)) {
            echo "Nome inválido. Digite um nome válido. \n";
        } else if (strlen($nome) < 3) {
            echo "Nome muito curto. Digite um nome com pelo menos 3 caracteres. \n";
        } else if ($nomeValido === 0) { // Permitir letras acentuadas e espaços
            echo "Nome inválido. Digite um nome válido. \n";
        } 
        
        
    } while (empty($nome) || strlen($nome) < 3 || $nomeValido === 0);
    
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
