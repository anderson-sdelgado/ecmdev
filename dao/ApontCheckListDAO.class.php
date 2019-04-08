<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of ApontaCheckList
 *
 * @author anderson
 */
class ApontCheckListDAO extends ConnDEV {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dadosCab, $dadosItem) {

        $this->Conn = parent::getConn();

        foreach ($dadosCab as $d) {

            $turno = 'null';
            $data = '';

            $select = " SELECT "
                    . " COUNT(ID) AS VERDATA "
                    . " INTO "
                    . " V_HORARIO "
                    . " FROM "
                    . " PERIODO_HORARIO_VERAO "
                    . " WHERE "
                    . " TO_DATE('" . $d->dtCabecCheckList . "','DD/MM/YYYY HH24:MI') BETWEEN  DATA_INICIAL AND DATA_FINAL";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $v = $item['VERDATA'];
            }

            if ($v == 0) {
                $data = ' - 3/24)';
            }
            else{
                $data = ' - 2/24)';
            }

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                    . " FROM "
                    . " BOLETIM_CHECK "
                    . " WHERE "
                    . " DT = (TO_DATE('" . $d->dtCabecCheckList . "','DD/MM/YYYY HH24:MI') " . $data 
                    . " AND "
                    . " EQUIP_NRO = " . $d->equipCabecCheckList . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $v = $item['QTDE'];
            }

            if ($v == 0) {

                $select = " SELECT "
                        . " NRO_TURNO "
                        . " FROM "
                        . " USINAS.V_SIMOVA_TURNO_EQUIP_NEW "
                        . " WHERE TURNOTRAB_ID = " . $d->turnoCabecCheckList;

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
                        . " " . $d->equipCabecCheckList . " "
                        . " , " . $d->funcCabecCheckList . ""
                        . " , (TO_DATE('" . $d->dtCabecCheckList . "','DD/MM/YYYY HH24:MI')" . $data
                        . " , " . $turno . ")";

                $this->Create = $this->Conn->prepare($sql);
                $this->Create->execute();

                $select = " SELECT "
                        . " ID_BOLETIM AS ID "
                        . " FROM "
                        . " BOLETIM_CHECK "
                        . " WHERE "
                        . " DT = (TO_DATE('" . $d->dtCabecCheckList . "','DD/MM/YYYY HH24:MI')" . $data
                        . " AND "
                        . " EQUIP_NRO = " . $d->equipCabecCheckList . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $idCab = $item['ID'];
                }

                foreach ($dadosItem as $i) {

                    if ($d->idCabecCheckList == $i->idCabecItemCheckList) {

                        $grupo = '';
                        $questao = '';

                        $select = " SELECT "
                                . " VIPC.ITMANPREV_ID AS ID, "
                                . " CARACTER(VIPC.PROC_OPER) AS QUESTAO, "
                                . " CARACTER(VCC.DESCR) AS GRUPO "
                                . " FROM "
                                . " V_ITEM_PLANO_CHECK VIPC "
                                . " , V_COMPONENTE_CHECK VCC "
                                . " WHERE "
                                . " VIPC.ITMANPREV_ID = " . $i->idItItemCheckList . " "
                                . " AND "
                                . " VIPC.COMPONENTE_ID = VCC.COMPONENTE_ID ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();


                        foreach ($result as $inf) {
                            $questao = $inf['QUESTAO'];
                            $grupo = $inf['GRUPO'];
                        }

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " ITEM_BOLETIM_CHECK "
                                . " WHERE "
                                . " ID_BOLETIM = " . $idCab . " "
                                . " AND "
                                . " ITMANPREV_ID = " . $i->idItItemCheckList . " ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $v = $item['QTDE'];
                        }

                        if ($v == 0) {

                            $sql = " INSERT INTO ITEM_BOLETIM_CHECK ( "
                                    . " ID_BOLETIM "
                                    . " , GRUPO "
                                    . " , QUESTAO "
                                    . " , RESP_CD "
                                    . " , ITMANPREV_ID "
                                    . " ) "
                                    . " VALUES ( "
                                    . " " . $idCab . " "
                                    . " , '" . $grupo . "' "
                                    . " , '" . $questao . "' "
                                    . " , " . $i->opcaoItemCheckList . " "
                                    . " , " . $i->idItItemCheckList . ")";

                            $this->Create = $this->Conn->prepare($sql);
                            $this->Create->execute();
                        }
                    }
                }
            } else {

                $select = " SELECT "
                        . " ID_BOLETIM AS ID "
                        . " FROM "
                        . " BOLETIM_CHECK "
                        . " WHERE "
                        . " DT = (TO_DATE('" . $d->dtCabecCheckList . "','DD/MM/YYYY HH24:MI') " . $data
                        . " AND "
                        . " EQUIP_NRO = " . $d->equipCabecCheckList . " ";

                $this->Read = $this->Conn->prepare($select);
                $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                $this->Read->execute();
                $result = $this->Read->fetchAll();

                foreach ($result as $item) {
                    $idCab = $item['ID'];
                }

                foreach ($dadosItem as $i) {

                    if ($d->idCabecCheckList == $i->idCabecItemCheckList) {

                        $grupo = '';
                        $questao = '';

                        $select = " SELECT "
                                . " VIPC.ITMANPREV_ID AS ID, "
                                . " CARACTER(VIPC.PROC_OPER) AS QUESTAO, "
                                . " CARACTER(VCC.DESCR) AS GRUPO "
                                . " FROM "
                                . " V_ITEM_PLANO_CHECK VIPC "
                                . " , V_COMPONENTE_CHECK VCC "
                                . " WHERE "
                                . " VIPC.ITMANPREV_ID = " . $i->idItItemCheckList . " "
                                . " AND "
                                . " VIPC.COMPONENTE_ID = VCC.COMPONENTE_ID ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();


                        foreach ($result as $inf) {
                            $questao = $inf['QUESTAO'];
                            $grupo = $inf['GRUPO'];
                        }

                        $select = " SELECT "
                                . " COUNT(*) AS QTDE "
                                . " FROM "
                                . " ITEM_BOLETIM_CHECK "
                                . " WHERE "
                                . " ID_BOLETIM = " . $idCab . " "
                                . " AND "
                                . " ITMANPREV_ID = " . $i->idItItemCheckList . " ";

                        $this->Read = $this->Conn->prepare($select);
                        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
                        $this->Read->execute();
                        $result = $this->Read->fetchAll();

                        foreach ($result as $item) {
                            $v = $item['QTDE'];
                        }

                        if ($v == 0) {

                            $sql = " INSERT INTO ITEM_BOLETIM_CHECK ( "
                                    . " ID_BOLETIM "
                                    . " , GRUPO "
                                    . " , QUESTAO "
                                    . " , RESP_CD "
                                    . " , ITMANPREV_ID "
                                    . " ) "
                                    . " VALUES ( "
                                    . " " . $idCab . " "
                                    . " , '" . $grupo . "' "
                                    . " , '" . $questao . "' "
                                    . " , " . $i->opcaoItemCheckList . " "
                                    . " , " . $i->idItItemCheckList . ")";

                            $this->Create = $this->Conn->prepare($sql);
                            $this->Create->execute();
                        }
                    }
                }
            }
        }
    }

}
