<?php

require('./control/ApontCheckListCTR.class.php');

$apontCheckListCTR = new ApontCheckListCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $apontCheckListCTR->salvarDados($info, 'apontchecklist2');
    
endif;
