<?php

require('./dao/LiberacaoDAO.class.php');

$liberacaoDAO = new LiberacaoDAO();

//cria o array associativo
$dados = array("dados"=>$liberacaoDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
