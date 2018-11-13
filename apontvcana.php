<?php

require('./dao/ApontVCanaDAO.class.php');

$apontVCanaDAO = new ApontVCanaDAO();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    //$dados = '{"dados":[{"cam":21270,"carr1":12026,"carr2":12025,"carr3":0,"dataChegCampo":"07/03/2017 16:26","dataSaidaCampo":"07/03/2017 16:28","dataSaidaUsina":"07/03/2017 16:26","id":1,"libCam":0,"libCarr1":31221,"libCarr2":31221,"libCarr3":0,"maqCam":0,"maqCarr1":0,"maqCarr2":0,"maqCarr3":0,"moto":1,"noteiro":19759,"opCam":0,"opCarr1":0,"opCarr2":0,"opCarr3":0,"turno":0}]}';

    $jsonObj = json_decode($info['dado']);
    //$jsonObj = json_decode($dados);
    $dados = $jsonObj->dados;  
    $retorno = $apontVCanaDAO->salvarDados($dados);

endif;

echo 'GRAVOU-CANA';