<?php

require('./dao/BuscaBoletimViagemDAO.class.php');

$buscaBoletimViagemDAO = new BuscaBoletimViagemDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //faz o parsing da string, criando o array "empregados"
    
    $jsonObj = json_decode($info['dado']);
    $dados = $jsonObj->dados;  
    
    $dados = array("dados" => $buscaBoletimViagemDAO->pesqInfo($dados));
    $buscaBoletimViagemDAO->delInfo();
    $json_str = json_encode($dados);
    echo $json_str;
    
endif;
