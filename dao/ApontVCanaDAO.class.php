<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'Conn.class.php';

/**
 * Description of InsMotoMecDAO
 *
 * @author anderson
 */
class ApontVCanaDAO extends Conn {
    //put your code here

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function salvarDados($dados) {

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

                $tabela = 'APONTAVIAGEMS';
                
                if((!empty($d->dataSaidaUsina)) && (!empty($d->dataSaidaCampo))  && (!empty($d->dataChegCampo))){
                    $tabela = 'APONTAVIAGEMS';
                }
                else{
                    $tabela = 'APONTAVS';
                }
                
                $insert = "INSERT INTO "
                        . $tabela
                        . " ( "
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
        }

    }

    private function verifValor($inf) {
        if ($inf == 0) {
            return 'null';
        } else {
            return $inf;
        }
    }

}
