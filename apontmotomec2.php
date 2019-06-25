<?php

require('./control/MotoMecCTR.class.php');

$motoMecCTR = new MotoMecCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $motoMecCTR->salvarDados($info, 'apontmotomec2');
    
endif;
