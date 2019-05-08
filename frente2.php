<?php

require('./dao/Frente2DAO.class.php');

$frenteDAO = new Frente2DAO();

//cria o array associativo
$dados = array("dados"=>$frenteDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
