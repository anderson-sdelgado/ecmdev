<?php

require('./dao/ItemCheckList2DAO.class.php');

$itemChecklistDAO = new ItemCheckList2DAO();

//cria o array associativo
$dados = array("dados"=>$itemChecklistDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
