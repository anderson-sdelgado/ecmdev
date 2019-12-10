<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
require_once ('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of MotoristaDAO
 *
 * @author anderson
 */
class MotoMecDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                . " OP.ID AS \"idOperMotoMec\" "
                . " , CASE "
                    . " WHEN OP.MOTPARADA_ID IS NOT NULL AND AA.ATIVAGR_ID IS NULL "
                    . " THEN MP.CD "
                    . " WHEN OP.MOTPARADA_ID IS NULL AND AA.ATIVAGR_ID IS NOT NULL "
                    . " THEN AA.CD "
                    . " ELSE 0 "
                    . " END AS \"codOperMotoMec\" "
                . " , CASE "
                    . " WHEN FUNCAO_COD = 1 "
                    . " THEN MP.DESCR "
                    . " ELSE FUOP.DESCR "
                    . " END AS \"descrOperMotoMec\" "
                . " , OP.FUNCAO_COD AS \"codFuncaoOperMotoMec\" "
                . " , OP.POSICAO AS \"posOperMotoMec\" "
                . " , OP.TIPO AS \"tipoOperMotoMec\" "
                . " , OP.APLIC AS \"aplicOperMotoMec\" "
                . " FROM " 
                . " OPCAO_MOTOMEC OP "
                . " , FUNCAO_OPCAO_MOTOMEC FUOP "
                . " , MOTIVO_PARADA MP "
                . " , ATIV_AGR AA "
                . " WHERE "
                . " OP.FUNCAO_COD = FUOP.COD "
                . " AND "
                . " OP.APLIC = FUOP.APLIC "
                . " AND "
                . " OP.MOTPARADA_ID = MP.MOTPARADA_ID(+) "
                . " AND "
                . " OP.ATIVAGR_ID = AA.ATIVAGR_ID(+) "
                . " ORDER BY " 
                . " OP.ID " 
                . " ASC ";
  
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
    public function salvarDados($dados) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();
        
        foreach ($dados as $d) {

            $sql = " INSERT INTO ECM_APONTAMENTO_MM "
                    . " ( ID "
                    . " , CAM "
                    . " , MOTO "
                    . " , OPCOR "
                    . " , DTHR"
                    . " , ATIV"
                    . " ) "
                    . " VALUES (  "
                    . " ECM_APONTAMENTO_MM_SEQ.NEXTVAL "
                    . " , " . $d->veic . ""
                    . " , " . $d->motorista . " "
                    . " , " . $d->opcor . " "
                    . " , " . $ajusteDataHoraDAO->dataHoraGMT($d->dihi)
                    . " , " . $d->caux . " )";

            $this->Conn = parent::getConn();
            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();
            
        }
    }
    
}
