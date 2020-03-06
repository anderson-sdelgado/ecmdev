<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/InserirLogDAO.class.php');
require_once('../model/dao/CabecCheckListDAO.class.php');
require_once('../model/dao/RespCheckListDAO.class.php');
/**
 * Description of ApontCheckListCTR
 *
 * @author anderson
 */
class ApontCheckListCTR {

    //put your code here

    public function salvarDados($info, $pagina) {

        $inserirLogDAO = new InserirLogDAO();

        $dados = $info['dado'];
        $inserirLogDAO->salvarDados($dados, $pagina);

        $posicao = strpos($dados, "_") + 1;
        $cabec = substr($dados, 0, ($posicao - 1));
        $item = substr($dados, $posicao);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjItem = json_decode($item);

        $dadosCab = $jsonObjCabec->cabecalho;
        $dadosItem = $jsonObjItem->item;

        if ($pagina == 'apontchecklist2') {
            $this->salvarBoletim($dadosCab, $dadosItem);
        }
//        elseif($pagina == 'apontchecklistdt'){
//            $this->salvarBoletimCDC($dadosCab, $dadosItem);
//        }
//        elseif($pagina == 'apontchecklist'){
//            $this->salvarBoletimSDC($dadosCab, $dadosItem);
//        }

        return 'GRAVOU-CHECKLIST';
    }
    
    private function salvarBoletim($dadosCab, $dadosItem) {
        $cabecCheckListDAO = new CabecCheckListDAO();
        foreach ($dadosCab as $d) {
            $v = $cabecCheckListDAO->verifCabecCheckList($d);
            if ($v == 0) {
                $cabecCheckListDAO->insCabecCheckList($d);
            }
            $idCabec = $cabecCheckListDAO->idCabecCheckList($d);
            $this->salvarApont($idCabec, $d->idCabecCheckList, $dadosItem);
        }
    }
    
    private function salvarApont($idBolBD, $idBolCel, $dadosItem) {
        $respCheckListDAO = new RespCheckListDAO();
        foreach ($dadosItem as $i) {
            if ($idBolCel == $i->idCabecItemCheckList) {
                $v = $respCheckListDAO->verifRespCheckList($idBolBD, $i);
                if ($v == 0) {
                    $respCheckListDAO->insRespCheckList($idBolBD, $i);
                }
            }
        }
    }

}
