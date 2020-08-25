<?php

/**
 * @author matheusquost
 */
require_once "Jogo.php";

class Tabuleiro {

    public $posicoes = array();

    public function setPosicoes($posicoes) {
        $this->posicoes = $posicoes;
    }

    public function getPosicoes() {
        return $this->posicoes;
    }

    public function setPosicao($valor, $lin, $col) {
        $this->posicoes[$lin][$col] = $valor;
    }

    public function getPosicao($lin, $col) {
        return $this->posicoes[$lin][$col];
    }

    public function Tabuleiro() {
        $this->zerarTabuleiro();
    }

    public function zerarTabuleiro() {
        for ($lin = 0; $lin < 3; $lin++) {
            for ($col = 0; $col < 3; $col++) {
                $this->setPosicao(0, $lin, $col);
            }
        }
        //$posicoes[$lin][$col]=0;
    }

    public function exibirTabuleiro() {
        print("\n");
        for ($lin = 0; $lin < 3; $lin++) {
            for ($col = 0; $col < 3; $col++) {
                if ($this->getPosicao($lin, $col) == -1) {
                    print(" X ");
                }
                if ($this->getPosicao($lin, $col) == 1) {
                    print(" O ");
                }
                if ($this->getPosicao($lin, $col) == 0) {
                    print("   ");
                }
                if ($col == 0 || $col == 1)
                    print("|");
            }
            print("\n");
        }
    }

    public function pegarPosicao($tentativa) {
        return $this->getPosicao($tentativa[0], $tentativa[1]);
    }

    public function posicionar($tentativa, $simbolo) {
        $this->setPosicao($simbolo, $tentativa[0], $tentativa[1]);
        $this->exibirTabuleiro();
    }

    public function verificaLinhas() {
        for ($lin = 0; $lin < 3; $lin++) {
            if (($this->getPosicao($lin, 0) + $this->getPosicao($lin, 1) + $this->getPosicao($lin, 2)) == -3)
                return -1;
            if (($this->getPosicao($lin, 0) + $this->getPosicao($lin, 1) + $this->getPosicao($lin, 2)) == 3)
                return 1;
        }
        return 0;
    }

    public function verificaColunas() {
        for ($col = 0; $col < 3; $col++) {
            if (($this->getPosicao(0, $col) + $this->getPosicao(1, $col) + $this->getPosicao(2, $col)) == -3)
                return -1;
            if (($this->getPosicao(0, $col) + $this->getPosicao(1, $col) + $this->getPosicao(2, $col)) == 3)
                return 1;
        }
        return 0;
    }

    public function verificaDiagonais() {
        if (($this->getPosicao(0, 0) + $this->getPosicao(1, 1) + $this->getPosicao(2, 2)) == -3)
            return -1;
        if (($this->getPosicao(0, 0) + $this->getPosicao(1, 1) + $this->getPosicao(2, 2)) == 3)
            return 1;
        if (($this->getPosicao(0, 2) + $this->getPosicao(1, 1) + $this->getPosicao(2, 0)) == -3)
            return -1;
        if (($this->getPosicao(0, 2) + $this->getPosicao(1, 1) + $this->getPosicao(2, 0)) == 3)
            return 1;
        return 0;
    }

    public function verificaTabuleiroCompleto() {
        for ($lin = 0; $lin < 3; $lin++)
            for ($col = 0; $col < 3; $col++)
                if ($this->getPosicao($lin, $col) == 0)
                    return false;
        return true;
    }

}
