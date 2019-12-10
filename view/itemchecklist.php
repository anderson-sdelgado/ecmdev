<?php

$versao = filter_input(INPUT_GET, 'versao', FILTER_DEFAULT);

require_once('../control/ItemCheckListCTR.class.php');

$itemCheckListCTR = new ItemCheckListCTR();

echo $itemCheckListCTR->dados($versao);
