<?php

/**
 * @author matheusquost
 */
require_once "Tabuleiro.php";
require_once "Humano.php";
require_once "Computador.php";

class Jogo {

    public $jogadores = array();
    public $rodada = 1;
    public $vez = 2;
    public $player = 0;

    public function inicializarJogo() {
        $jogadores = $this->escolherJogadores();
        $tabuleiro = new Tabuleiro();
        $this->jogar($jogadores, $tabuleiro);
    }

    public function escolherJogadores() {
        $op = 0;
        $op2 = 0;
        $jogadores = array();

        while ($op != 2 && $op != 1) {
            print("\nQuem será o Jogador 1?");
            print("\n1. Humano");
            print("\n2. Computador");
            print("\nOpcão escolhida: ");
            $op = readline();
            if ($op != 1 && $op != 2) {
                print("Opção Inválida! Tente novamente!\n");
                $op = 0;
            }
        }
        if ($op == 1) {
            print("\nDigite o nome do Jogador 1: ");
            $nome = readline();
            while ($op2 != 2 && $op2 != 1) {
                print("\nQual o símbolo de " . $nome . "?");
                print("\n1. X");
                print("\n2. O");
                print("\nOpcão escolhida: ");
                $op2 = readline();
                if ($op2 != 1 && $op2 != 2) {
                    print("Opção Inválida! Tente novamente!\n");
                    $op2 = 0;
                }
            }
            if ($op2 == 1)
                $jogadores[0] = new Humano($nome, -1);
            else
                $jogadores[0] = new Humano($nome, 1);
        } else {
            while ($op2 != 2 && $op2 != 1) {
                print("\nQual o símbolo do computador 1?");
                print("\n1. X");
                print("\n2. O");
                print("\nOpcão escolhida: ");
                $op2 = readline();
                if ($op2 != 1 && $op2 != 2) {
                    print("Opção Inválida! Tente novamente!\n");
                    $op2 = 0;
                }
            }
            if ($op2 == 1) {
                $jogadores[0] = new Computador("Computador 1", -1);
            } else {
                $jogadores[0] = new Computador("Computador 1", 1);
            }
            $op3=0;
            while ($op3 != 2 && $op3 != 1) {
                print("\nQual o nível do computador 1?");
                print("\n1. Fácil");
                print("\n2. Difícil");
                print("\nOpcão escolhida: ");
                $op3 = readline();
                if ($op3 != 1 && $op3 != 2) {
                    print("Opção Inválida! Tente novamente!\n");
                    $op3 = 0;
                }
            }
            if ($op3 == 1) {
                $jogadores[0]->setNivel(0);
            } else {
                $jogadores[0]->setNivel(1);
            }
        }
        if ($jogadores[0]->getSimbolo() == -1)
            print("\nJogador 1 criado!\n" . $jogadores[0]->getTipo() . " - " . $jogadores[0]->getNome() . " - X\n");
        else {
            print("\nJogador 1 criado!\n" . $jogadores[0]->getTipo() . " - " . $jogadores[0]->getNome() . " - O\n");
        }
        $op = 0;
        while ($op != 2 && $op != 1) {
            print("\nE agora, quem será o Jogador 2?");
            print("\n1. Humano");
            print("\n2. Computador");
            print("\nOpcão escolhida: ");
            $op = readline();
            if ($op != 1 && $op != 2) {
                print("Opção Inválida! Tente novamente!\n");
                $op = 0;
            }
        }
        if ($op == 1) {
            print("\nDigite o nome do Jogador 2: ");
            $nome = readline();
            if ($op2 == 1) {
                $jogadores[1] = new Humano($nome, 1);
            } else {
                $jogadores[1] = new Humano($nome, -1);
            }
        } else {
            if ($op2 == 1) {
                $jogadores[1] = new Computador("Computador 2", 1);
            } else {
                $jogadores[1] = new Computador("Computador 2", -1);
            }
            $op3 = 0;
            while ($op3 != 2 && $op3 != 1) {
                print("\nQual o nível do computador 2?");
                print("\n1. Fácil");
                print("\n2. Difícil");
                print("\nOpcão escolhida: ");
                $op3 = readline();
                if ($op3 != 1 && $op3 != 2) {
                    print("Opção Inválida! Tente novamente!\n");
                    $op3 = 0;
                }
            }
            if ($op3 == 1) {
                $jogadores[1]->setNivel(0);
            } else {
                $jogadores[1]->setNivel(1);
            }
        }
        if ($jogadores[1]->getSimbolo() == -1)
            print("\nJogador 2 criado!\n" . $jogadores[1]->getTipo() . " - " . $jogadores[1]->getNome() . " - X\n");
        else {
            print("\nJogador 2 criado!\n" . $jogadores[1]->getTipo() . " - " . $jogadores[1]->getNome() . " - O\n");
        }
        print("\n");
        return $jogadores;
    }

    public function jogar($jogadores, $tabuleiro) {
        $op = 0;
        $jogadores[1]->setComeca(false);
        $jogadores[0]->setComeca(false);
        while ($op != 2 && $op != 1) {
            print("Como definir quem começa?");
            print("\n1. Sortear");
            print("\n2. Escolher");
            print("\nOpcão escolhida: ");
            $op = readline();
            if ($op != 1 && $op != 2) {
                print("Opção Inválida! Tente novamente!\n");
                $op = 0;
            }
            print("\n");
        }
        if ($op == 1) {
            $this->player = rand(0, 1);
            $jogadores[$this->player]->setComeca(true);
            print($jogadores[$this->player]->getNome() . " foi sorteado(a) para começar!\n");
        } else {
            $op = 0;
            while ($op != 2 && $op != 1) {
                print("Quem começa?");
                print("\n1. " . $jogadores[0]->getNome());
                print("\n2. " . $jogadores[1]->getNome());
                print("\nOpcão escolhida: ");
                $op = readline();
                if ($op != 1 && $op != 2) {
                    print("Opção Inválida! Tente novamente!\n");
                    $op = 0;
                }
                if($op==1){
                    $this->player=0;
                }else{
                    $this->player=1;
                }
            }
            print("\n");
            print($jogadores[$this->player]->getNome() . " foi o escolhido(a) para começar!\n");
            $jogadores[$this->player]->setComeca(true);
        }
        while ($this->partida($tabuleiro, $jogadores));
    }

    public function verificaGanhador($tabuleiro) {
        if ($tabuleiro->verificaLinhas() == 1)
            return 1;
        if ($tabuleiro->verificaColunas() == 1)
            return 1;
        if ($tabuleiro->verificaDiagonais() == 1)
            return 1;
        if ($tabuleiro->verificaLinhas() == -1)
            return -1;
        if ($tabuleiro->verificaColunas() == -1)
            return -1;
        if ($tabuleiro->verificaDiagonais() == -1)
            return -1;
        return 0;
    }

    public function partida($tabuleiro, $jogadores) {
        if ($this->verificaGanhador($tabuleiro) == 0) {
            if ($tabuleiro->verificaTabuleiroCompleto()) {
                print("\nTabuleiro Completo. DEU VELHA! Jogo empatado.\n");
                return false;
            }
            print("\n----------------------");
            print("\nRodada: " . $this->rodada);
            print("\nÉ a vez de " . $jogadores[$this->player]->getNome() . "!\n");

            $tabuleiro = $jogadores[$this->player]->jogar($tabuleiro, $this->rodada);

            $this->vez++;
            $this->rodada++;

            if ($this->player == 1) {
                $this->player = 0;
            } else {
                $this->player = 1;
            }
            return true;
        } else {
            if ($this->verificaGanhador($tabuleiro) == -1) {
                if ($jogadores[0]->getSimbolo() == -1) {
                    print("\n" . $jogadores[0]->getNome() . " ganhou!\n");
                } else {
                    print("\n" . $jogadores[1]->getNome() . " ganhou!\n");
                }
                return false;
            } else {
                if ($jogadores[1]->getSimbolo() == 1) {
                    print("\n" . $jogadores[1]->getNome() . " ganhou!\n");
                } else {
                    print("\n" . $jogadores[0]->getNome() . " ganhou!\n");
                }
                return false;
            }
            return false;
        }
    }

    public function defineVez() {
        if ($this->vez % 2 == 1) {
            return 1;
        } else {
            return 2;
        }
    }

}
