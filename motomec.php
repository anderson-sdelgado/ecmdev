<?php

require('./dao/MotoMecDAO.class.php');

$motoMecDAO = new MotoMecDAO();

//cria o array associativo
$dados = array("dados"=>$motoMecDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
