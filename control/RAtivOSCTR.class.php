<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/RAtivOSDAO.class.php');
/**
 * Description of ROSAtiv
 *
 * @author anderson
 */
class RAtivOSCTR {

    //put your code here

    public function dados() {

        $rAtivOSDAO = new RAtivOSDAO();

        $dados = array("dados" => $rAtivOSDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
    }

    public function pesqInfo($info) {

        $rAtivOSDAO = new RAtivOSDAO();
        
        $dado = $info['dado'];
        
        $dados = array("dados" => $rAtivOSDAO->pesqInfo($dado));
        $json_str = json_encode($dados);
        
        return $json_str;
    }

}
