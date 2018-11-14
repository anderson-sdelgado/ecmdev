<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ConnDEV.class.php';
/**
 * Description of ItemChecklistDAO
 *
 * @author anderson
 */
class ItemChecklistDAO extends ConnDEV {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " ITMANPREV_ID AS \"idItemChecklist\" "
                        . " , PLMANPREV_ID AS \"idChecklist\" "
                        . " , SEQ AS \"seqItemChecklist\" "
                        . " , CARACTER(PROC_OPER) AS \"descrItemChecklist\" "
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
