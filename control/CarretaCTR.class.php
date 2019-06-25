<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/CarretaDAO.class.php');
/**
 * Description of CarretaCTR
 *
 * @author anderson
 */
class CarretaCTR {
    //put your code here
    
    public function dados() {
        
        $carretaDAO = new CarretaDAO();
       
        $dados = array("dados"=>$carretaDAO->dados());
        $json_str = json_encode($dados);
        
        return $json_str;
        
    }
    
}
