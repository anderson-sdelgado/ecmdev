<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
require_once 'AjusteDataHoraDAO.class.php';
/**
 * Description of InsMotoMecDAO
 *
 * @author anderson
 */
class ApontMotoMec2DAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();
        
        foreach ($dados as $d) {

            $sql = " INSERT INTO ECM_APONTAMENTO_MM "
                    . " ( ID "
                    . " , CAM "
                    . " , MOTO "
                    . " , OPCOR "
                    . " , DTHR"
                    . " , ATIV"
                    . " ) "
                    . " VALUES (  "
                    . " ECM_APONTAMENTO_MM_SEQ.NEXTVAL "
                    . " , " . $d->veic . ""
                    . " , " . $d->motorista . " "
                    . " , " . $d->opcor . " "
                    . " , " . $ajusteDataHoraDAO->dataHora($d->dihi)
                    . " , " . $d->caux . " )";

            $this->Conn = parent::getConn();
            $this->Create = $this->Conn->prepare($sql);
            $this->Create->execute();
            
        }
    }

    
}
