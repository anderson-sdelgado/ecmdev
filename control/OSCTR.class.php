<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/OSDAO.class.php');
/**
 * Description of OSCTR
 *
 * @author anderson
 */
class OSCTR {
    //put your code here
    
    public function dados() {
        
        $osDAO = new OSDAO();
        
        $dados = array("dados"=>$osDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
