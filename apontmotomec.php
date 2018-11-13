<?php

require('./dao/ApontMotoMecDAO.class.php');

$apontMotoMecDAO = new ApontMotoMecDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"caux":0,"dihi":"31/01/2017 15:20","id":1,"motorista":1,"opcor":443,"veic":2223}]}';

    //faz o parsing da string, criando o array "empregados"
    $jsonObj = json_decode($info['dado']);
    //$jsonObj = json_decode($dados);
    $dados = $jsonObj->dados;
    $apontMotoMecDAO->salvarDados($dados);

endif;

echo 'GRAVOU-MOTOMEC';
