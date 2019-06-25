<?php

require('./control/PreCECCTR.class.php');

$preCECCTR = new PreCECCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $preCECCTR->salvarDados($info, 'apontvcana2');
    
endif;