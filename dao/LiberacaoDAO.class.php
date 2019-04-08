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
class LiberacaoDAO extends ConnDEV {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                        . " NRO_LIB_OS AS \"codigoLiberacao\" "
                        . " , CD_TPCORTE AS \"tipoLiberacao\" "
                        . " , CD_FAZENDA AS \"codFazendaLiberacao\" "
                        . " , CARACTER(NOME_FAZENDA) AS \"nomeFazendaLiberacao\" "
                        . " , NRO_OS AS \"nroOSLiberacao\" "
                    . " FROM "
                        . " USINAS.V_INTEGRA_LIBERACAO ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
