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
class Frente2DAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " FRENTE_ID AS \"idFrente\" "
                    . " , CD AS \"codFrente\" "
                    . " , DESCR AS \"descrFrente\" "
                . " FROM "
                    . " USINAS.FRENTE "
                . " WHERE "
                    . " ATIVO = 1 "
                    . " AND "
                    . " TP_FRENTE = 3 "
                . " ORDER BY "
                    . " CD "
                . " DESC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
