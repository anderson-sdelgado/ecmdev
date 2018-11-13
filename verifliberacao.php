<?php

require('./dao/VerLiberacaoDAO.class.php');

$verLiberacaoDAO = new VerLiberacaoDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //faz o parsing da string, criando o array "empregados"
    $dados = array("dados" => $verLiberacaoDAO->pesqInfo($info['dado']));
    $json_str = json_encode($dados);
    echo $json_str;
    
endif;