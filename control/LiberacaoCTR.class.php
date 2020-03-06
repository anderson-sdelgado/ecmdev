<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LiberacaoDAO.class.php');
/**
 * Description of LiberacaoCTR
 *
 * @author anderson
 */
class LiberacaoCTR {
    //put your code here
    
    public function dados() {
        
        $liberacaoDAO = new LiberacaoDAO();
       
        $dados = array("dados"=>$liberacaoDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
