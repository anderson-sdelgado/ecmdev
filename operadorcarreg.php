<?php

require('./dao/OperadorCarregDAO.class.php');

$operadorCarregDAO = new OperadorCarregDAO();

//cria o array associativo
$dados = array("dados"=>$operadorCarregDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
