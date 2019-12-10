<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/ROSLiberCTR.class.php');

$rOSLiberCTR = new ROSLiberCTR();

echo $rOSLiber->dados($versao);
