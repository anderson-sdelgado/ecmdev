<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/PreCECDAO.class.php');
require_once('../model/dao/InserirLogDAO.class.php');

/**
 * Description of CecCTR
 *
 * @author anderson
 */
class PreCECCTR {

    //put your code here

    public function salvarDados($info, $pagina) {

        $preCECDAO = new PreCECDAO();

        $inserirLogDAO = new InserirLogDAO();
        $dados = $info['dado'];
        $inserirLogDAO->salvarDados($dados, $pagina);

        $jsonObj = json_decode($dados);
        $dado = $jsonObj->dados;
        foreach ($dado as $d) {
            $preCECDAO->salvarDados($d);
        }

        return 'GRAVOU-CANA';
    }

}
