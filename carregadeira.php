<?php

require('./dao/CarregadeiraDAO.class.php');

$carregadeiraDAO = new CarregadeiraDAO();

//cria o array associativo
$dados = array("dados"=>$carregadeiraDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
