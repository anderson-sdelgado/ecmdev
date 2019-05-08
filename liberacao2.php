<?php

require('./dao/Liberacao2DAO.class.php');

$liberacaoDAO = new Liberacao2DAO();

//cria o array associativo
$dados = array("dados"=>$liberacaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
