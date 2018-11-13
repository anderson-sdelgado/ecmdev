<?php

require('./dao/CarretaDAO.class.php');

$carretaDAO = new CarretaDAO();

//cria o array associativo
$dados = array("dados"=>$carretaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;