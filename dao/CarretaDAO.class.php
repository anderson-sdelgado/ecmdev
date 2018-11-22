<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ConnDEV.class.php';
/**
 * Description of MotoristaDAO
 *
 * @author anderson
 */
class CarretaDAO extends ConnDEV {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " EQUIP_ID AS \"idCarreta\" "
                        . " , NRO AS \"codCarreta\" "
                        . " , " 
                        . " CASE " 
                        . " WHEN NRO_CLASSE = 216 THEN 8 "
                        . " ELSE TIPO_CLASSE "
                        . " END AS \"tipoCarreta\" "
                    . " FROM "
                        . " USINAS.V_INTEGRA_EQUIPAMENTO "
                    . " WHERE "
                        . " (TIPO_CLASSE IN (4, 8) OR NRO_CLASSE = 212) "
                    . " AND "
                        . " DATA_DESATIVACAO IS NULL "
                    . " ORDER BY NRO DESC "; 
        
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
