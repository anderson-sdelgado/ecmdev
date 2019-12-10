<?php

require('./dao/VerLib2DAO.class.php');

$verLibDAO = new VerLib2DAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //faz o parsing da string, criando o array "empregados"
    $dados = array("dados" => $verLibDAO->pesqInfo($info['dado']));
    $json_str = json_encode($dados);
    echo $json_str;
    
endif;