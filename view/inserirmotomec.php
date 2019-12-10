<?php

require('./dao/ApontMotoMec2DAO.class.php');

$apontMotoMecDAO = new ApontMotoMec2DAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"caux":0,"dihi":"31/01/2017 15:20","id":1,"motorista":1,"opcor":443,"veic":2223}]}';

    $jsonObj = json_decode($info['dado']);
    $dados = $jsonObj->dados;
    $apontMotoMecDAO->salvarDados($dados);

endif;

echo 'GRAVOU-MOTOMEC';
