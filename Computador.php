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

    public function Computador($nome, $simbolo) {
        $this->setNome($nome);
        $this->setSimbolo($simbolo);
        $this->setTipo("Computador");
        $this->jogada = 0;
        $this->setIsComputer(true);
        $this->setNivel(1);
    }

    public function jogar($tabuleiro) {
        if($this->nivel=1){
            $tentativa= $this->nivelFacil($tabuleiro);
        }else{
            $tentativa = $this->nivelDificil($tabuleiro);
        }
        $tabuleiro->posicionar($tentativa, $this->getSimbolo());
        sleep(2);
        return $tabuleiro;
    }
    
    public function nivelFacil($tabuleiro){
        do{
            $this->tentativa[0]=rand(0,2);
            $this->tentativa[1]=rand(0,2);
        } while (!$this->checarTentativa($this->tentativa, $tabuleiro));
        sleep(1);
        print("\nLinha: ".($this->tentativa[0]+1)."\nColuna: ".($this->tentativa[1]+1)."\n");
        sleep(2);
        return $this->tentativa; 
    }

    public function nivelDificil($tabuleiro) {
        for($lin=0;$lin<3;$lin++){
            for($col=0;$col<3;$col++){
                // code here; 
            }
        }
            
        do {
            if ($this->getComeca() == true) {
                if ($this->jogada == 0) {
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
                } else if ($this->jogada == 2) {
                    if ($tabuleiro->getPosicao(1, 1) == 0) {
                        return $this->tentativa($this->tentativa, 1, 1);
                    } else {
                        if ($tabuleiro->getPosicao(0, 0) == $this->getSimbolo()) {
                            return $this->tentativa($this->tentativa, 2, 2);
                        } else if ($tabuleiro->getPosicao(0, 2) == $this->getSimbolo()) {
                            return $this->tentativa($this->tentativa, 2, 0);
                        } else if ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo()) {
                            return $this->tentativa($this->tentativa, 0, 2);
                        } else if ($tabuleiro->getPosicao(2, 2) == $this->getSimbolo()) {
                            return $this->tentativa($this->tentativa, 0, 0);
                        }
                    }
                } else if ($this->jogada == 3) {
                    if ($tabuleiro->getPosicao(1, 1) == $this->getSimbolo()) {
                        if ($tabuleiro->getPosicao(0, 0) == $this->getSimbolo()) {
                            if ($tabuleiro->getPosicao(2, 2) == 0) {
                                return $this->tentativa($this->tentativa, 2, 2);
                            }
                        } else if ($tabuleiro->getPosicao(0, 2) == $this->getSimbolo()) {
                            if ($tabuleiro->getPosicao(2, 0) == 0) {
                                return $this->tentativa($this->tentativa, 2, 0);
                            }
                        } else if ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo()) {
                            if ($tabuleiro->getPosicao(0, 2) == 0) {
                                return $this->tentativa($this->tentativa, 0, 2);
                            }
                        } else if ($tabuleiro->getPosicao(2, 2) == $this->getSimbolo()) {
                            if ($tabuleiro->getPosicao(0, 0) == 0) {
                                return $this->tentativa($this->tentativa, 0, 0);
                            }
                        }
                    } else {
                        if (($tabuleiro->getPosicao(2, 2) == $this->getSimbolo()) && ($tabuleiro->getPosicao(0, 0) == $this->getSimbolo())) {
                            if ($tabuleiro->getPosicao(0, 2) == $this->getSimbolo() * -1) {
                                if ($tabuleiro->getPosicao(2, 0) == 0) {
                                    return $this->tentativa($this->tentativa, 2, 0);
                                }
                            } else if ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo() * -1) {
                                if ($tabuleiro->getPosicao(0, 2) == 0) {
                                    return $this->tentativa($this->tentativa, 0, 2);
                                }
                            }
                        } else if (($tabuleiro->getPosicao(0, 2) == $this->getSimbolo()) && ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo())) {
                            if ($tabuleiro->getPosicao(0, 0) == $this->getSimbolo() * -1) {
                                if ($tabuleiro->getPosicao(2, 2) == 0) {
                                    return $this->tentativa($this->tentativa, 2, 2);
                                }
                            } else if ($tabuleiro->getPosicao(2, 2) == $this->getSimbolo() * -1) {
                                if ($tabuleiro->getPosicao(0, 0) == 0) {
                                    return $this->tentativa($this->tentativa, 0, 0);
                                }
                            }
                        } else if ($this->jogada == 4) {
                            if (($tabuleiro->getPosicao(0, 2) == $this->getSimbolo()) && ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo())) {
                                if ($tabuleiro->getPosicao(0, 0) == $this->getSimbolo()) {
                                    if ($tabuleiro->getPosicao(0, 1) == 0) {
                                        if ($tabuleiro->getPosicao(0, 1) == 0) {
                                            return $this->tentativa($this->tentativa, 0, 1);
                                        }
                                    } else if ($tabuleiro->getPosicao(1, 0) == 0) {
                                        if ($tabuleiro->getPosicao(1, 0) == 0) {
                                            return $this->tentativa($this->tentativa, 1, 0);
                                        }
                                    }
                                } else if ($tabuleiro->getPosicao(2, 2) == $this->getSimbolo()) {
                                    if ($tabuleiro->getPosicao(1, 2) == 0) {
                                        if ($tabuleiro->getPosicao(1, 2) == 0) {
                                            return $this->tentativa($this->tentativa, 1, 2);
                                        }
                                    } else if ($tabuleiro->getPosicao(2, 1) == 0) {
                                        if ($tabuleiro->getPosicao(2, 1) == 0) {
                                            return $this->tentativa($this->tentativa, 2, 1);
                                        }
                                    }
                                }
                            } else if (($tabuleiro->getPosicao(0, 0) == $this->getSimbolo()) && ($tabuleiro->getPosicao(2, 2) == $this->getSimbolo())) {
                                if ($tabuleiro->getPosicao(0, 2) == $this->getSimbolo()) {
                                    if ($tabuleiro->getPosicao(0, 1) == 0) {
                                        if ($tabuleiro->getPosicao(0, 1) == 0) {
                                            return $this->tentativa($this->tentativa, 0, 1);
                                        }
                                    } else if ($tabuleiro->getPosicao(1, 2) == 0) {
                                        if ($tabuleiro->getPosicao(1, 2) == 0) {
                                            return $this->tentativa($this->tentativa, 1, 2);
                                        }
                                    }
                                } else if ($tabuleiro->getPosicao(2, 0) == $this->getSimbolo()) {
                                    if ($tabuleiro->getPosicao(1, 0) == 0) {
                                        if ($tabuleiro->getPosicao(1, 0) == 0) {
                                            return $this->tentativa($this->tentativa, 1, 0);
                                        }
                                    } else if ($tabuleiro->getPosicao(2, 1) == 0) {
                                        if ($tabuleiro->getPosicao(2, 1) == 0) {
                                            return $this->tentativa($this->tentativa, 2, 1);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } while (!$this->checarTentativa($this->tentativa, $tabuleiro));
    }

    public function tentativa($tentativa, $lin, $col) {
        $tentativa[0] = $lin;
        $tentativa[1] = $col;
        $this->jogada++;
        return $tentativa;
    }
    
    public function setNivel($nivel) {
        $this->nivel= $nivel;
    }

    public function getNivel() {
        return $this->nivel;
    }

}
