<?php

require('./dao/Carregadeira2DAO.class.php');

$carregadeiraDAO = new Carregadeira2DAO();

//cria o array associativo
$dados = array("dados"=>$carregadeiraDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
