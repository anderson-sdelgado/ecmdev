<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('./dbutil/Conn.class.php');
require_once('./model/dao/AjusteDataHoraDAO.class.php');

/**
 * Description of InsMotoMecDAO
 *
 * @author anderson
 */
class PreCECDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($d) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $insert = " INSERT INTO "
                . " ECM_PRE_CEC_CANA "
                . " ( ID, EQUIP, LIB_EQUIP, COLHED_EQUIP, OPER_COLHED_EQUIP, COLABORADOR "
                . " , CARRETA_1, LIB_CARRETA_1, COLHED_CARRETA_1, OPER_COLHED_CARRETA_1 "
                . " , CARRETA_2, LIB_CARRETA_2, COLHED_CARRETA_2, OPER_COLHED_CARRETA_2 "
                . " , CARRETA_3, LIB_CARRETA_3, COLHED_CARRETA_3, OPER_COLHED_CARRETA_3 "
                . " , DATA_HORA_CHEGADA_CAMPO, DATA_HORA_SAIDA_CAMPO, DATA_HORA_SAIDA_USINA "
                . " , NOTEIRO, TURNO "
                . " ) "
                . " VALUES ( "
                . " ECM_PRE_CEC_CANA_SEQ.NEXTVAL "
                . " , " . $d->cam . " "
                . " , " . $this->verifValor($d->libCam) . " "
                . " , " . $this->verifValor($d->maqCam) . " "
                . " , " . $this->verifValor($d->opCam) . " "
                . " , " . $d->moto . " "
                . " , " . $this->verifValor($d->carr1) . " "
                . " , " . $this->verifValor($d->libCarr1) . " "
                . " , " . $this->verifValor($d->maqCarr1) . " "
                . " , " . $this->verifValor($d->opCarr1) . " "
                . " , " . $this->verifValor($d->carr2) . " "
                . " , " . $this->verifValor($d->libCarr2) . " "
                . " , " . $this->verifValor($d->maqCarr2) . " "
                . " , " . $this->verifValor($d->opCarr2) . " "
                . " , " . $this->verifValor($d->carr3) . " "
                . " , " . $this->verifValor($d->libCarr3) . " "
                . " , " . $this->verifValor($d->maqCarr3) . " "
                . " , " . $this->verifValor($d->opCarr3) . " "
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($d->dataChegCampo)
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($d->dataSaidaCampo)
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($d->dataSaidaUsina)
                . " , " . $d->moto . " "
                . " , " . $this->verifValor($d->turno) . " "
                . " ) ";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($insert);
        $this->Create->execute();
        
        return $d->cam;
        
    }

    private function verifValor($inf) {
        if ($inf == 0) {
            return 'null';
        } else {
            return $inf;
        }
    }

}
