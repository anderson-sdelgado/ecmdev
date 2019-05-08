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
class Noteiro2DAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " FM.FUNC_CD AS \"codNoteiro\" "
                . " FROM "
                    . " V_SIMOVA_TURMA_FUNC TF "
                    . " , V_SIMOVA_FUNC_MOBRA FM "
                . " WHERE "
                    . " TF.TURMA_ID <> 111 "
                    . " AND "
                    . " TF.FUNC_ID = FM.FUNC_ID  "
                . " ORDER BY "
                    . " FM.FUNC_CD "
                . " DESC ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
