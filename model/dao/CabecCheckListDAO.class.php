<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
require_once ('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabecChecklist
 *
 * @author anderson
 */
class CabecCheckListDAO extends Conn {

    public function verifCabecCheckList($cab) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " BOLETIM_CHECK "
                . " WHERE "
                . " DT = " . $ajusteDataHoraDAO->dataHoraGMT($cab->dtCabecCheckList)
                . " AND "
                . " EQUIP_NRO = " . $cab->equipCabecCheckList . " ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idCabecCheckList($cab) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $select = " SELECT "
                . " ID_BOLETIM AS ID "
                . " FROM "
                . " BOLETIM_CHECK "
                . " WHERE "
                . " DT = " . $ajusteDataHoraDAO->dataHoraGMT($cab->dtCabecCheckList)
                . " AND "
                . " EQUIP_NRO = " . $cab->equipCabecCheckList . " ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insCabecCheckList($cab) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $select = " SELECT "
                . " NRO_TURNO "
                . " FROM "
                . " USINAS.V_SIMOVA_TURNO_EQUIP_NEW "
                . " WHERE TURNOTRAB_ID = " . $cab->turnoCabecCheckList;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $turno = $item['NRO_TURNO'];
        }

        $sql = " INSERT INTO BOLETIM_CHECK ( "
                . " EQUIP_NRO "
                . " , FUNC_CD "
                . " , DT "
                . " , NRO_TURNO "
                . " ) "
                . " VALUES ( "
                . " " . $cab->equipCabecCheckList
                . " , " . $cab->funcCabecCheckList
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cab->dtCabecCheckList)
                . " , " . $turno . ")";

		$this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

}
