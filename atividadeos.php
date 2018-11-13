<?php

require('./dao/AtividadeOSDAO.class.php');

$atividadeOSDAO = new AtividadeOSDAO();

//cria o array associativo
$dados = array("dados"=>$atividadeOSDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
