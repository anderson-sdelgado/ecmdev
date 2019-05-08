<?php

require('./dao/Caminhao2DAO.class.php');

$caminhaoDAO = new Caminhao2DAO();

//cria o array associativo
$dados = array("dados"=>$caminhaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
