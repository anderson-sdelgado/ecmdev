<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of VerAtividade
 *
 * @author anderson
 */
class VerAtividadeDAO extends ConnDEV {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function pesqInfo($dado) {

        $select = " SELECT DISTINCT "
                . " OS.ID_ATIV_OS AS \"codigoAtivOS\" "
                . " , OS.NRO_OS AS \"nroOSAtivOS\" "
                . " , CARACTER(OS.NOME_FAZENDA) AS \"nomeAtivOS\" "
                . " FROM "
                . " USINAS.V_INTEGRA_OS OS "
                . " WHERE "
                . " OS.ID_ATIV_OS = " . $dado . " ";


        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }

}
