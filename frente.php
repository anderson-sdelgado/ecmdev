<?php

require('./dao/FrenteDAO.class.php');

$frenteDAO = new FrenteDAO();

//cria o array associativo
$dados = array("dados"=>$frenteDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
