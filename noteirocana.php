<?php

require('./dao/NoteiroCanaDAO.class.php');

$noteiroCanaDAO = new NoteiroCanaDAO();

//cria o array associativo
$dados = array("dados"=>$noteiroCanaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
