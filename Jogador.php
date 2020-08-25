<?php

/**
 * @author matheusquost
 */
class Jogador {

    public $nome;
    public $isComputer;
    public $simbolo;
    public $tipo;
    public $comeca;

    public function checarTentativa($tentativa, $tabuleiro) {
        if ($tabuleiro->pegarPosicao($tentativa) == 0)
            return true;
        else
            return false;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setIsComputer($isComputer) {
        $this->isComputer = $isComputer;
    }

    public function getIsComputer() {
        return $this->isComputer;
    }

    public function setSimbolo($simbolo) {
        $this->simbolo = $simbolo;
    }

    public function getSimbolo() {
        return $this->simbolo;
    }

    public function setComeca($comeca) {
        $this->comeca = $comeca;
    }

    public function getComeca() {
        return $this->comeca;
    }

}
