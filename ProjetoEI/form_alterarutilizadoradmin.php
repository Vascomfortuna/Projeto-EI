<?php

include "./functions.php";
$idutilizador = filter_input(INPUT_POST, "idutilizador");
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");
$nome = filter_input(INPUT_POST, "nome");
$contacto = filter_input(INPUT_POST, "contacto");
$iniciais = filter_input(INPUT_POST, "iniciais");
$voip = filter_input(INPUT_POST, "voip");
$partida = filter_input(INPUT_POST, "partida");
$destino = filter_input(INPUT_POST, "destino");
$cor = filter_input(INPUT_POST, "cor");

if(empty($nlugares)){
    $nlugares=4;
}
if(empty($voip)){
    $voip="null";
}
if(empty($contacto)){
    $contacto="null";
}
if(empty($partida)){
    $partida="";
}
if(empty($destino)){
    $destino="";
}

$query = "UPDATE utilizadores SET email='$email', partida='$partida', destino='$destino', contacto='$contacto', nome='$nome', nlugares=$nlugares, "
        . "iniciais='$iniciais', voip=$voip, cor='$cor' "
        . "where idutilizador = $idutilizador;";

$result = ligacao($query);
if (!$result) {
            echo "delimitador7/<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }



