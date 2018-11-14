<?php
 require('./dao/TipoFuncCamDAO.class.php');
 
 $tipoFuncCamDAO = new TipoFuncCamDAO();
 
 //cria o array associativo
$dados = array("dados"=>$tipoFuncCamDAO->dados());

 //converte o conteúdo do array associativo para uma string JSON

$json_str = json_encode($dados);
 //imprime a string JSON

echo $json_str;
