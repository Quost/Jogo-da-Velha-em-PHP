<?php

/**
 * @author matheusquost
 */
require_once "Jogo.php";

$op = 0;

while ($op != 2) {
    print("Você deseja jogar uma partida de Jogo da Velha?");
    print("\n1. Sim");
    print("\n2. Não");
    print("\nOpcão escolhida: ");
    $op = readline();
    if ($op != 1 && $op != 2) {
        print("Opção Inválida! Tente novamente!\n");
        $op = 0;
    }
    if ($op == 1) {
        $jogo = new Jogo();
        $jogo->inicializarJogo();
        print("Partida Finalizada!\n\n");
        sleep(3);
    }    
    
    
}