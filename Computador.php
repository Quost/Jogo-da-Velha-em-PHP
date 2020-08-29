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
    private $a5 = array(), $a7 = array(), $a9 = array();
    private $marcarMeio = false;
    private $chance = false;

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
            sleep(1);
        }
        $tabuleiro->posicionar($tentativa, $this->getSimbolo());
        sleep(1);
        return $tabuleiro;
    }

    public function nivelFacil($tabuleiro) {
        do {
            $this->tentativa[0] = rand(0, 2);
            $this->tentativa[1] = rand(0, 2);
        } while (!$this->checarTentativa($this->tentativa, $tabuleiro));
        sleep(1);
        print("\nLinha: " . ($this->tentativa[0] + 1) . "\nColuna: " . ($this->tentativa[1] + 1) . "\n");
        sleep(1);
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
                    } while (($posicao[0] == $this->a2[0]) || ($posicao[1] == $this->a2[1]));
                    $this->a3 = $posicao;
                    $this->marcarMeio = true;
                    return $this->a3;
                }
            } else if ($rodada == 5) {
                $this->a5 = $this->dicaProximoLance($tabuleiro);
                if ($this->a5 != -2) {
                    return $this->a5;
                } else if ($this->marcarMeio) {
                    $this->a5 = array(1, 1);
                    return $this->a5;
                }
                $naoOp = $this->cantoNaoOposto($this->a1);
                $Op = $this->cantoOposto($naoOp);
                $naoOp = $tabuleiro->pegarPosicao($naoOp);
                $simbolo = $this->simbolo * -1;
                if ($naoOp == $simbolo || $Op == $simbolo) {
                    if ($naoOp == $simbolo) {
                        $this->a5 = $Op;
                        return $this->a5;
                    } else {
                        $this->a5 = $naoOp;
                        return $this->a5;
                    }
                }
            } else {
                if ($this->dicaProximoLance($tabuleiro) != -2) {
                    return $this->dicaProximoLance($tabuleiro);
                }
            }
        } else {
            $this->mapeiaTabuleiro($tabuleiro);
            if ($rodada == 2) {
                if ($this->verificaSeLado($this->a1)) {
                    $this->chance = true;
                    $this->a2 = array(1, 1);
                    return $this->a2;
                } else if ($this->verificaSeCanto($this->a1)) {
                    $this->a2 = array(1, 1);
                    return $this->a2;
                } else {
                    do {
                        $this->a2 = $this->rodada1($tabuleiro);
                    } while (!$this->checarTentativa($this->a2, $tabuleiro));
                    return $this->a2;
                }
            } else {
                if ($chance == true) {

                    if ($tabuleiro->getPosicao($this->a2[1], $this->a2[0]) == $this->getSimbolo() * -1) {
                        $this->a3 = getPosicao($this->a2[1], $this->a2[0]);
                        $this->a4 = $this->rodada1($tabuleiro);
                        $this->chance = false;
                        return $this->a4;
                    }
                }
                if ($this->dicaProximoLance($tabuleiro) != -2) {
                    return $this->dicaProximoLance($tabuleiro);
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
        $rand = rand(0, 1);
        if (($posicao == array(0, 0)) || ($posicao == array(2, 2))) {
            if ($rand == 0) {
                return array(0, 2);
            } else {
                return array(2, 0);
            }
        } else {
            if ($rand == 0) {
                return array(0, 0);
            } else {
                return array(2, 2);
            }
        }
    }

    public function mapeiaVitoria($tabuleiro, $simbolo) {
        if ($tabuleiro->VerificaPossivelVitoriaLinhas($simbolo) != -1) {
            return $tabuleiro->VerificaPossivelVitoriaLinhas($simbolo);
        } else if ($tabuleiro->VerificaPossivelVitoriaColunas($simbolo) != -1) {
            return $tabuleiro->VerificaPossivelVitoriaColunas($simbolo);
        } else if ($tabuleiro->VerificaPossivelVitoriaDiagonais($simbolo) != -1) {
            return $tabuleiro->VerificaPossivelVitoriaDiagonais($simbolo);
        } else {
            return -2;
        }
    }

    public function mapeiaDerrota($tabuleiro, $simbolo) {
        $simbolo = $simbolo * -1;
        return $this->mapeiaVitoria($tabuleiro, $simbolo);
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

    public function dicaProximoLance($tabuleiro) {
        $posicao = $this->mapeiaVitoria($tabuleiro, $this->getSimbolo());
        if ($posicao != -2) {
            return $posicao;
        } else {
            $posicao = $this->mapeiaDerrota($tabuleiro, $this->getSimbolo());
            if ($posicao != -2) {
                return $posicao;
            }
        }
        if ($tabuleiro->posicionaLinha($this->getSimbolo()) != -1) {
            return $tabuleiro->posicionaLinha($this->getSimbolo());
        } else {
            if ($tabuleiro->posicionaColuna($this->getSimbolo()) != -1) {
                return $tabuleiro->posicionaColuna($this->getSimbolo());
            }
        }
        return -2;
    }

}
