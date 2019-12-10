<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of EquipDAO
 *
 * @author anderson
 */
class EquipDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " E.EQUIP_ID AS \"idEquip\" "
                        . " , E.NRO_EQUIP AS \"nroEquip\" "
                        . " , "
                        . " CASE " 
                            . " WHEN E.CLASSOPER_CD IN (1, 8) "
                            . " THEN 1 "
                            . " WHEN E.CLASSOPER_CD = 35 "
                            . " THEN 2 "
                            . " ELSE 3 "
                        . " END AS \"tipoEquip\" "
                        . " , E.CLASSOPER_CD AS \"classeEquip\" "
                        . " , NVL(C.PLMANPREV_ID, 0) AS \"idCheckListEquip\" "
                        . " , NVL(E.TPTUREQUIP_CD, 0) AS \"idTurnoEquip\" "
                    . " FROM "
                        . " V_EQUIP E "
                        . " , USINAS.V_EQUIP_PLANO_CHECK C "
                    . " WHERE "
                        . " E.CLASSOPER_CD IN (1, 8, 5, 21, 35, 36, 216) "
                        . " AND "
                        . " E.NRO_EQUIP = C.EQUIP_NRO(+) ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
