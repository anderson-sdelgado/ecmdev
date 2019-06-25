<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ROSLiberDAO
 *
 * @author anderson
 */
class ROSLiberDAO {
    //put your code here
    
    public function pesqInfo($os, $lib) {

        $select = " SELECT DISTINCT "
                . " NRO_LIB_OS AS \"codigoLiberacao\" "
                . " , CD_TPCORTE AS \"tipoLiberacao\" "
                . " , CARACTER(NOME_FAZENDA) AS \"nomeLiberacao\" "
                . " , NRO_OS AS \"nroOSLiberacao\" "
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
