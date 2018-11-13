<?php

require('./dao/CaminhaoDAO.class.php');

$caminhaoDAO = new CaminhaoDAO();

//cria o array associativo
$dados = array("dados"=>$caminhaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
