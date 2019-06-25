<?php

require('./control/ROSAtivCTR.class.php');

$rOSAtivCTR = new ROSAtivCTR();
$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    echo $retorno = $rOSAtivCTR->pesqInfo($info);

endif;