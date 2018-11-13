<?php

require('./dao/NoteiroVinhacaDAO.class.php');

$noteiroVinhacaDAO = new NoteiroVinhacaDAO();

//cria o array associativo
$dados = array("dados"=>$noteiroVinhacaDAO->dados());

//converte o conteúdo do array associativo para uma string JSON
$json_str = json_encode($dados);

//imprime a string JSON
echo $json_str;
