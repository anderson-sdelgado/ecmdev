<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/RLiberOSCTR.class.php');

$rOSLiberCTR = new ROSLiberCTR();

echo $rOSLiber->dados($versao);
