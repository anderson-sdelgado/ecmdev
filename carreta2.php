<?php

require('./dao/Carreta2DAO.class.php');

$carretaDAO = new Carreta2DAO();

//cria o array associativo
$dados = array("dados"=>$carretaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;