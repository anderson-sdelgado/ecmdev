<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/CECDAO.class.php');
require_once('../model/dao/PreCECDAO.class.php');
require_once('../model/dao/InserirLogDAO.class.php');
/**
 * Description of CECCTR
 *
 * @author anderson
 */
class CECCTR {

    //put your code here

    public function buscarDados($info, $pagina) {

        $cecDAO = new CECDAO();

        $inserirLogDAO = new InserirLogDAO();
        $dados = $info['dado'];
        $inserirLogDAO->salvarDados($dados, $pagina);

        $d = array("dados" => $cecDAO->pesqInfCEC($dados));
        $cecDAO->delInfCEC($dados);
        $json_str = json_encode($d);
        return $json_str;
    }
    
    public function buscarInsDados($info, $pagina) {

        $cecDAO = new CECDAO();
        $preCECDAO = new PreCECDAO();

        $inserirLogDAO = new InserirLogDAO();
        $dados = $info['dado'];
        $inserirLogDAO->salvarDados($dados, $pagina);

        $cam = 0;
        
        $jsonObj = json_decode($dados);
        $dd = $jsonObj->dados;
        foreach ($dd as $d) {
            $cam = $preCECDAO->salvarDados($d);
        }

        $d = array("dados" => $cecDAO->pesqInfCEC($cam));
        $cecDAO->delInfCEC($cam);
        $json_str = json_encode($d);

        return $json_str;
    }

}
