<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/RLiberOSDAO.class.php');
/**
 * Description of ROSLiberCTR
 *
 * @author anderson
 */
class ROSLiberCTR {

    //put your code here

    public function pesqInfo($info) {

        $rOSLiberDAO = new ROSLiberDAO();

        $dado = $info['dado'];

        $posicao = strpos($dado, "_") + 1;
        $lib = substr($dado, 0, ($posicao - 1));
        $os = substr($dado, $posicao);

        $dados = array("dados" => $rOSLiberDAO->pesqInfo($os, $lib));
        $json_str = json_encode($dados);

        return $json_str;
    }

}
