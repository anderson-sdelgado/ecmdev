<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of ROSLiberDAO
 *
 * @author anderson
 */
class RLiberOSDAO {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;
    
    public function dados() {

        $select = " SELECT DISTINCT "
                        . " NRO_LIB_OS AS \"codLib\" "
                        . " , CD_TPCORTE AS \"tipoLib\" "
                        . " , CARACTER(CD_FAZENDA) AS \"codFazenda\" "
                        . " , CARACTER(NOME_FAZENDA) AS \"descFazenda\" "
                        . " , NRO_OS AS \"nroOS\" "
                    . " FROM "
                        . " USINAS.V_INTEGRA_LIBERACAO ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
    public function pesqInfo($os, $lib) {

        $select = " SELECT DISTINCT "
                        . " NRO_LIB_OS AS \"codLib\" "
                        . " , CD_TPCORTE AS \"tipoLib\" "
                        . " , CARACTER(CD_FAZENDA) AS \"codFazenda\" "
                        . " , CARACTER(NOME_FAZENDA) AS \"descFazenda\" "
                        . " , NRO_OS AS \"nroOS\" "
                    . " FROM "
                        . " USINAS.V_INTEGRA_LIBERACAO "
                    . " WHERE "
                        . " NRO_LIB_OS = " . $lib
                        . " AND "
                        . " NRO_OS = " . $os;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
