<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/EquipCTR.class.php');

$equipCTR = new EquipCTR();

echo $equipCTR->dados($versao);
