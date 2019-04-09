<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of MotoristaDAO
 *
 * @author anderson
 */
class CaminhaoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " E.EQUIP_ID AS \"idCaminhao\" "
                    . " , E.NRO AS \"codCaminhao\" "
                    . " , E.TIPO_CLASSE AS \"tipoCaminhao\" "
                    . " , NVL(C.PLMANPREV_ID, 0) AS \"idChecklist\" "
                    . " , E.TPTUREQUIP_CD AS \"codTurno\" "
                . " FROM "
                    . " USINAS.V_INTEGRA_EQUIPAMENTO E "
                    . " , USINAS.V_EQUIP_PLANO_CHECK C "
                . " WHERE "
                    . " E.TIPO_CLASSE IN (1, 6, 5) "
                    . " AND "
                    . " E.NRO = C.EQUIP_NRO(+) "
                . " ORDER BY "
                    . " NRO "
                . " DESC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
