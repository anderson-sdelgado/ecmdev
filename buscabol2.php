<?php

require('./control/CECCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $cecCTR = new CECCTR();
    echo $cecCTR->buscarDados($info, "buscabol2");
    
endif;
