<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/ColabCTR.class.php');

$colabCTR = new ColabCTR();

echo $colabCTR->dados($versao);
