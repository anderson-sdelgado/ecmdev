<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';
require_once 'AjusteDataHoraDAO.class.php';
/**
 * Description of BuscaBoletimDAO
 *
 * @author anderson
 */
class BuscaBoletimViagem2DAO extends Conn {
    /** @var PDOStatement */

    /** @var PDOStatement */
    private $Read;
    /** @var PDO */
    private $Conn;

    private $c = null;
    
    public function pesqInfo($dados) {

        $this->Conn = parent::getConn();
        $ajusteDataHoraDAO = new AjusteDataHoraDAO();
        
        foreach ($dados as $d) {

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
                    . " , " . $ajusteDataHoraDAO->dataHora($d->dataChegCampo)
                    . " , " . $ajusteDataHoraDAO->dataHora($d->dataSaidaCampo)
                    . " , " . $ajusteDataHoraDAO->dataHora($d->dataSaidaUsina)
                    . " , " . $d->moto . " "
                    . " , " . $this->verifValor($d->turno) . " "
                    . " ) ";

            $this->Create = $this->Conn->prepare($insert);
            $this->Create->execute();
            
            $this->c = $d->cam;
            
        }
        
        $result = null;
        
        while (empty($result)) {

            $select = " SELECT "
                            . " CAMINHAO AS \"caminhaoBoleto\" "
                            . " , CD_FRENTE AS \"cdFrenteBoleto\" "
                            . " , CEC_PAI AS \"cecPaiBoleto\" "
                            . " , TO_CHAR(DT_HR_ENTRADA, 'DD/MM/YYYY HH24:MI') AS \"dthrEntradaBoleto\" "
                            . " , POSSUI_SORTEIO AS \"possuiSorteioBoleto\" "
                            . " , NVL(CEC_SORTEADO_1, 0) AS \"cecSorteado1Boleto\" "
                            . " , NVL(UNID_SORTEADA_1, 0) AS \"unidadeSorteada1Boleto\" "
                            . " , NVL(CEC_SORTEADO_2, 0) AS \"cecSorteado2Boleto\" "
                            . " , NVL(UNID_SORTEADA_2, 0) AS \"unidadeSorteada2Boleto\" "
                            . " , NVL(CEC_SORTEADO_3, 0) AS \"cecSorteado3Boleto\" "
                            . " , NVL(UNID_SORTEADA_3, 0) AS \"unidadeSorteada3Boleto\" "
                            . " , PESO_LIQUIDO AS \"pesoLiquidoBoleto\" "
                    . " FROM "
                            . " INTEGRACAO.ULTIMAVIAGEM "
                    . " WHERE "
                            . " CAMINHAO = " . $this->c;

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();
        }

        return $result;
    }

    public function delInfo() {

        $sql = " call pk_integra_balanca.pkb_apaga_ultviagem(?)";
        $this->Conn = parent::getConn();
        $stmt = $this->Conn->prepare($sql);
        $stmt->bindParam(1, $this->c, PDO::PARAM_INT, 32);

        $stmt->execute();
    }

    private function verifValor($inf) {
        if ($inf == 0) {
            return 'null';
        } else {
            return $inf;
        }
    }
    
}
