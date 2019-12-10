<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./model/dao/MotoMecDAO.class.php');
require_once('./model/dao/InserirLogDAO.class.php');
/**
 * Description of MotoMecCTR
 *
 * @author anderson
 */
class MotoMecCTR {

    //put your code here

    public function dados($versao) {

        $versao = str_replace("_", ".", $versao);
        
        if($versao >= 2.00){
        
            $motoMecDAO = new MotoMecDAO();

            $dados = array("dados" => $motoMecDAO->dados());
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }

    public function salvarDados($info, $pagina) {

        $motoMecDAO = new MotoMecDAO();
        
        $inserirLogDAO = new InserirLogDAO();
        $dados = $info['dado'];
        $inserirLogDAO->salvarDados($dados, $pagina);
        
        $jsonObj = json_decode($dados);
        $d = $jsonObj->dados;
        $motoMecDAO->salvarDados($d);
        
        return 'GRAVOU-MOTOMEC';
        
    }

}
