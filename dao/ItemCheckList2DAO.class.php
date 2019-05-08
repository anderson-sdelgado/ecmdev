<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
/**
 * Description of ItemChecklistDAO
 *
 * @author anderson
 */
class ItemChecklist2DAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " ITMANPREV_ID AS \"idItemCheckList\" "
                        . " , PLMANPREV_ID AS \"idCheckList\" "
                        . " , SEQ AS \"seqItemCheckList\" "
                        . " , CARACTER(PROC_OPER) AS \"descrItemCheckList\" "
                    . " FROM "
                        . " V_ITEM_PLANO_CHECK "
                    . " ORDER BY "
                            . " SEQ "
                    . " ASC ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
