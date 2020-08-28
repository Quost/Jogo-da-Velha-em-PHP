<?php

/**
 * @author matheusquost
 */
require_once "Jogador.php";
require_once "Tabuleiro.php";

class Computador extends Jogador {

    private $jogada = 0;
    private $tentativa = array();
    private $nivel;
    private $mapa = array();
    private $cont = 0;
    private $a1 = array(), $a2 = array(), $a3 = array(), $a4 = array();
    private $a5 = array(), $a6 = array(), $a7 = array(), $a8 = array(), $a9 = array();

    public function Computador($nome, $simbolo) {
        $this->setNome($nome);
        $this->setSimbolo($simbolo);
        $this->setTipo("Computador");
        $this->jogada = 0;
        $this->setIsComputer(true);
        $this->setNivel(1);
    }

    public function jogar($tabuleiro, $rodada) {
        if ($this->getNivel() == 0) {
            $tentativa = $this->nivelFacil($tabuleiro);
        } else {
            $tentativa = $this->nivelDificil($tabuleiro, $rodada);
            sleep(1);
            print("\nLinha: " . ($tentativa[0] + 1) . "\nColuna: " . ($tentativa[1] + 1) . "\n");
            sleep(2);
        }
        $tabuleiro->posicionar($tentativa, $this->getSimbolo());
        sleep(2);
        return $tabuleiro;
    }

    public function nivelFacil($tabuleiro) {
        do {
            $this->tentativa[0] = rand(0, 2);
            $this->tentativa[1] = rand(0, 2);
        } while (!$this->checarTentativa($this->tentativa, $tabuleiro));
        sleep(1);
        print("\nLinha: " . ($this->tentativa[0] + 1) . "\nColuna: " . ($this->tentativa[1] + 1) . "\n");
        sleep(2);
        return $this->tentativa;
    }

    public function nivelDificil($tabuleiro, $rodada) {
        if ($this->getComeca() == true) {
            if ($rodada == 1) {
                $this->a1 = $this->rodada1($tabuleiro);
                return $this->a1;
            } else if ($rodada == 3) {
                $this->mapeiaTabuleiro($tabuleiro);
                if ($this->a1 == $this->mapa[0]) {
                    $this->a2 = $this->mapa[1];
                } else {
                    $this->a2 = $this->mapa[0];
                }
                if ($this->a2 == array(1, 1)) {
                    $this->a3 = $this->cantoOposto($this->a1);
                    return $this->a3;
                } else if ($this->verificaSeCanto($this->a2)) {
                    if ($this->cantoOposto($this->a1) == $this->a2) {
                        $this->a3 = $this->cantoNaoOposto($this->a2);
                        return $this->a3;
                    } else {
                        $this->a3 = array(1, 1);
                        return $this->a3;
                    }
                } else {
                    do {
                        $posicao = $this->cantoNaoOposto($this->a1);
                    } while (($posicao[0] == $this->a2[0]) && ($posicao[1] == $this->a2[1]));
                    return $posicao;
                }
            } else if ($rodada == 5) {
                $this->mapeiaTabuleiro($tabuleiro);
                $this->mapeiaDerrota($tabuleiro);
            }
        } else {
            $this->mapeiaTabuleiro($tabuleiro);
            if ($rodada == 2) {
                if ($this->verificaSeLado($this->a1)) {
                    return array(1, 1);
                } else if ($this->verificaSeCanto($this->a1)) {
                    return array(1, 1);
                } else {
                    return $this->rodada1($tabuleiro);
                }
            }
        }
    }

    public function rodada1($tabuleiro) {

        $rand = rand(1, 4);
        if ($rand == 1 || $rand == 2) {
            $this->tentativa[0] = 0;
            if ($rand == 1) {
                $this->tentativa[1] = 0;
            } else {
                $this->tentativa[1] = 2;
            }
        } else {
            $this->tentativa[0] = 2;
            if ($rand == 3) {
                $this->tentativa[1] = 0;
            } else {
                $this->tentativa[1] = 2;
            }
        }
        $this->jogada++;
        return $this->tentativa;
    }

    public function verificaSeCanto($posicao) {
        if (($posicao == array(0, 0)) || ($posicao == array(0, 2)) || ($posicao == array(2, 0)) || ($posicao == array(2, 2))) {
            return true;
        } else {
            return false;
        }
    }

    public function verificaSeLado($posicao) {
        if (($posicao == array(0, 1)) || ($posicao == array(1, 0)) || ($posicao == array(1, 2)) || ($posicao == array(2, 1))) {
            return true;
        } else {
            return false;
        }
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function cantoOposto($posicao) {
        if ($posicao == array(2, 2)) {
            return array(0, 0);
        } else if ($posicao == array(0, 0)) {
            return array(2, 2);
        } else if ($posicao == array(2, 0)) {
            return array(0, 2);
        } else if ($posicao == array(0, 2)) {
            return array(2, 0);
        }
    }

    public function cantoNaoOposto($posicao) {
        if ($posicao[0] - 2 == 0) {
            if ($posicao[1] - 2 == 0) {
                return array(0, 2);
            } else {
                return array(0, 0);
            }
        } else {
            if ($posicao[1] == 0) {
                return array(0, 2);
            } else {
                return array(0, 0);
            }
        }
    }

    public function mapeiaDerrota() {
        
    }

    public function mapeiaTabuleiro($tabuleiro) {
        for ($lin = 0; $lin < 3; $lin++) {
            for ($col = 0; $col < 3; $col++) {
                if ($tabuleiro->getPosicao($lin, $col) != 0) {
                    $this->mapa[$this->cont] = array($lin, $col);
                    $this->cont++;
                }
            }
        }
    }

}
