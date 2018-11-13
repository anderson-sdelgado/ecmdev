<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of BuscaBoletimDAO
 *
 * @author anderson
 */
class BuscaBoletimViagemDAO extends Conn {
    /** @var PDOStatement */

    /** @var PDOStatement */
    private $Read;
    /** @var PDO */
    private $Conn;

    private $c = null;
    
    public function pesqInfo($dados) {

        $result = null;
        
        foreach ($dados as $d) {

            $select = " SELECT COUNT(*) AS QTDE FROM APONTAVIAGEMS ";

            $this->Conn = parent::getConn();
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $qtde = $item['QTDE'];
                $qtde = $qtde + 1;
            }

            $select = " SELECT "
                    . " COUNT(*) AS QTDE "
                    . " FROM "
                    . " APONTAVIAGEMS "
                    . " WHERE "
                    . " DTSAIDCAMP = TO_DATE('" . $d->dataSaidaCampo . "','DD/MM/YYYY HH24:MI') "
                    . " AND "
                    . " CAMINHAO = " . $d->cam . " ";

            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();

            foreach ($result as $item) {
                $v = $item['QTDE'];
            }

            if ($v == 0) {

                $insert = "INSERT INTO APONTAVIAGEMS ( "
                        . " IDVIAGEM "
                        . " , CAMINHAO "
                        . " , LIBCAM "
                        . " , MAQCAM "
                        . " , OPCAM "
                        . " , MOTORISTA "
                        . " , CARRETA1 "
                        . " , LIBCAR1 "
                        . " , MAQCAR1 "
                        . " , OPCAR1 "
                        . " , CARRETA2 "
                        . " , LIBCAR2 "
                        . " , MAQCAR2 "
                        . " , OPCAR2 "
                        . " , CARRETA3 "
                        . " , LIBCAR3 "
                        . " , MAQCAR3 "
                        . " , OPCAR3 "
                        . " , DTCHEGCAMP "
                        . " , DTSAIDCAMP "
                        . " , DTSAIDUSIN "
                        . " , NOTEIRO "
                        . " , TURNO "
                        . " ) "
                        . " VALUES ( "
                        . " " . $qtde . " "
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
                        . " , TO_DATE('" . $d->dataChegCampo . "' , 'DD/MM/YYYY HH24:MI') "
                        . " , TO_DATE('" . $d->dataSaidaCampo . "' , 'DD/MM/YYYY HH24:MI') "
                        . " , TO_DATE('" . $d->dataSaidaUsina . "' , 'DD/MM/YYYY HH24:MI') "
                        . " , " . $d->moto . " "
                        . " , " . $this->verifValor($d->turno) . " "
                        . " ) ";

                //$this->Conn = parent::getConn();
                $this->Create = $this->Conn->prepare($insert);
                $this->Create->execute();
                
            }
            
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
