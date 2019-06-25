<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/LocalDAO.class.php');
/**
 * Description of LocalCTR
 *
 * @author anderson
 */
class LocalCTR {
    //put your code here
    
    public function dados() {
        
        $localDAO = new LocalDAO();
       
        $dados = array("dados"=>$localDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
