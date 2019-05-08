<?php

require('./dao/Local2DAO.class.php');

$localDAO = new Local2DAO();

//cria o array associativo
$dados = array("dados"=>$localDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
