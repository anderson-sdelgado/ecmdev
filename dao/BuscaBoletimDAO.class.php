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
class BuscaBoletimDAO extends ConnDEV {
    /** @var PDOStatement */

    /** @var PDO */
    private $Conn;

    public function pesqInfo($dado) {

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
                            . " CAMINHAO = " . $dado . " ";

            $this->Conn = parent::getConn();
            $this->Read = $this->Conn->prepare($select);
            $this->Read->setFetchMode(PDO::FETCH_ASSOC);
            $this->Read->execute();
            $result = $this->Read->fetchAll();
        }

        return $result;
//        return $select;
    }

    public function delInfo($dado) {

        $sql = " call pk_integra_balanca.pkb_apaga_ultviagem(?)";
        $this->Conn = parent::getConn();
        $stmt = $this->Conn->prepare($sql);
        $stmt->bindParam(1, $dado, PDO::PARAM_INT, 32);

        $stmt->execute();
    }

}
