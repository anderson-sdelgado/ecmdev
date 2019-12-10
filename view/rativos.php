<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/RAtivOSCTR.class.php');

$rAtivOSCTR = new RAtivOSCTR();

echo $rAtivOSCTR->dados($versao);
