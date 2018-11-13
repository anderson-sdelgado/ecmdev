<?php

require('./dao/LocalDAO.class.php');

$localDAO = new LocalDAO();

//cria o array associativo
$dados = array("dados"=>$localDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
