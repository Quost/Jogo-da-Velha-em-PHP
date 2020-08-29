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

    public function pegarPosicao($tentativa) {
        return $this->getPosicao($tentativa[0], $tentativa[1]);
    }

    public function posicionar($tentativa, $simbolo) {
        $this->setPosicao($simbolo, $tentativa[0], $tentativa[1]);
        $this->exibirTabuleiro();
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
    
    public function posicionaLinha($simbolo){
        for ($lin = 0; $lin < 3; $lin++) {
            if ((($this->getPosicao($lin, 0) + $this->getPosicao($lin, 1) + $this->getPosicao($lin, 2)) == $simbolo) && ((($this->getPosicao($lin, 0) == 0) || ($this->getPosicao($lin, 1) == 0) || ($this->getPosicao($lin, 2) == 0)))) {
                if ($this->getPosicao($lin, 0) == 0) {
                    return array($lin, 0);
                } else if ($this->getPosicao($lin, 1) == 0) {
                    return array($lin, 1);
                } else {
                    return array($lin, 2);
                }
            }
        }
        return -1;
    }
    
    public function posicionaColuna($simbolo){
        for ($col = 0; $col < 3; $col++) {
            if ((($this->getPosicao(0, $col) + $this->getPosicao(1, $col) + $this->getPosicao(2, $col)) == $simbolo) && ((($this->getPosicao(0, $col) == 0) || ($this->getPosicao(1, $col) == 0) || ($this->getPosicao(2, $col) == 0)))) {
                if ($this->getPosicao(0, $col) == 0) {
                    return array(0, $col);
                } else if ($this->getPosicao(1, $col) == 0) {
                    return array(1, $col);
                } else {
                    return array(2, $col);
                }
            }
        }
        return -1;
    }

    public function VerificaPossivelVitoriaLinhas($simbolo) {
        $verificador = $simbolo * 2;
        for ($lin = 0; $lin < 3; $lin++) {
            if ((($this->getPosicao($lin, 0) + $this->getPosicao($lin, 1) + $this->getPosicao($lin, 2)) == $verificador) && ((($this->getPosicao($lin, 0) == 0) || ($this->getPosicao($lin, 1) == 0) || ($this->getPosicao($lin, 2) == 0)))) {
                if ($this->getPosicao($lin, 0) == 0) {
                    return array($lin, 0);
                } else if ($this->getPosicao($lin, 1) == 0) {
                    return array($lin, 1);
                } else {
                    return array($lin, 2);
                }
            }
        }
        return -1;
    }

    public function VerificaPossivelVitoriaColunas($simbolo) {
        $verificador = $simbolo * 2;
        for ($col = 0; $col < 3; $col++) {
            if ((($this->getPosicao(0, $col) + $this->getPosicao(1, $col) + $this->getPosicao(2, $col)) == $verificador) && ((($this->getPosicao(0, $col) == 0) || ($this->getPosicao(1, $col) == 0) || ($this->getPosicao(2, $col) == 0)))) {
                if ($this->getPosicao(0, $col) == 0) {
                    return array(0, $col);
                } else if ($this->getPosicao(1, $col) == 0) {
                    return array(1, $col);
                } else {
                    return array(2, $col);
                }
            }
        }
        return -1;
    }

    public function VerificaPossivelVitoriaDiagonais($simbolo) {
        $verificador = $simbolo * 2;
        if (($this->getPosicao(0, 0) + $this->getPosicao(1, 1) + $this->getPosicao(2, 2)) == $verificador) {
            if ($this->getPosicao(0, 0) == 0 || $this->getPosicao(1, 1) == 0 || $this->getPosicao(2, 2) == 0) {
                if ($this->getPosicao(1, 1) == 0) {
                    return array(1, 1);
                } else if ($this->getPosicao(0, 0) == 0) {
                    return array(0, 0);
                } else if ($this->getPosicao(2, 2) == 0) {
                    return array(2, 2);
                }
            }
        } else if (($this->getPosicao(0, 2) + $this->getPosicao(1, 1) + $this->getPosicao(2, 0)) == $verificador) {
            if ($this->getPosicao(0, 2) == 0 || $this->getPosicao(1, 1) == 0 || $this->getPosicao(2, 0) == 0) {
                if ($this->getPosicao(1, 1) == 0)
                    return array(1, 1);
                if ($this->getPosicao(0, 2) == 0)
                    return array(0, 2);
                if ($this->getPosicao(2, 0) == 0)
                    return array(2, 0);
            }
        }
        return -1;
    }

    public function verificaTabuleiroCompleto() {
        for ($lin = 0; $lin < 3; $lin++) {
            for ($col = 0; $col < 3; $col++) {
                if ($this->getPosicao($lin, $col) == 0) {
                    return false;
                }
            }
        }
        return true;
    }

}
