<?php   

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