<?php

require('./dao/BuscaBoletim2DAO.class.php');

$buscaBoletimDAO = new BuscaBoletim2DAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //faz o parsing da string, criando o array "empregados"
    $dados = array("dados" => $buscaBoletimDAO->pesqInfo($info['dado']));
    $buscaBoletimDAO->delInfo($info['dado']);
    $json_str = json_encode($dados);
    echo $json_str;
//    echo $dados;
    
endif;
