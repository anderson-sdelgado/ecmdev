<?php

require('./control/CarregadeiraCTR.class.php');

$carregadeiraCTR = new CarregadeiraCTR();

echo $carregadeiraCTR->dados();
