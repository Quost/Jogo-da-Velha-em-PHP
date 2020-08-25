<?php

/**
 * @author matheusquost
 */
require_once "Jogador.php";

class Humano extends Jogador {

    public function Humano($nome, $simbolo) {
        $this->setNome($nome);
        $this->setIsComputer(false);
        $this->setSimbolo($simbolo);
        $this->setTipo("Humano");
    }

    public function jogar($tabuleiro) {
        $tentativa = $this->setarLance($tabuleiro);
        $tabuleiro->posicionar($tentativa, $this->getSimbolo());
        return $tabuleiro;
    }

    public function setarLance($tabuleiro) {
        $tentativa = array();
        do {
            do {
                print("\nLinha: ");
                $tentativa[0] = readline();

                if ($tentativa[0] > 3 || $tentativa[0] < 1)
                    print("\nLinha inválida. As opções são: 1, 2 ou 3\n");
            } while ($tentativa[0] > 3 || $tentativa[0] < 1);

            do {
                print("Coluna: ");
                $tentativa[1] = readline();

                if ($tentativa[1] > 3 || $tentativa[1] < 1)
                    print("Coluna inválida. As opções são: 1, 2 ou 3\n");
            } while ($tentativa[1] > 3 || $tentativa[1] < 1);

            $tentativa[0]--;
            $tentativa[1]--;

            if (!$this->checarTentativa($tentativa, $tabuleiro))
                print("\nEsse local já foi marcado. Tente outro.");
        }while (!$this->checarTentativa($tentativa, $tabuleiro));
        return $tentativa;
    }

}
