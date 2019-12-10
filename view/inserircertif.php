<?php

require('./dao/ApontVCana2DAO.class.php');

$apontVCanaDAO = new ApontVCana2DAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"cam":326,"carr1":2619,"carr2":0,"carr3":0,"dataChegCampo":"22/11/2018 07:25","dataSaidaCampo":"22/11/2018 07:29","dataSaidaUsina":"22/11/2018 07:25","idCompVCana":1,"libCam":0,"libCarr1":32679,"libCarr2":0,"libCarr3":0,"maqCam":0,"maqCarr1":0,"maqCarr2":0,"maqCarr3":0,"moto":1,"noteiro":19085,"opCam":0,"opCarr1":0,"opCarr2":0,"opCarr3":0,"turno":2}]}';

    $jsonObj = json_decode($info['dado']);
    //$jsonObj = json_decode($dados);
    $dados = $jsonObj->dados;  
    $retorno = $apontVCanaDAO->salvarDados($dados);

endif;

echo 'GRAVOU-CANA';