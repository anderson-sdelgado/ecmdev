<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/MotoMecCTR.class.php');

$frenteCTR = new MotoMecCTR();

echo $frenteCTR->dados($versao);
