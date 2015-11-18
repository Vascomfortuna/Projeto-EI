<?php
include "./functions.php";
$nome=utf8_encode(filter_input(INPUT_POST, "nome"));
$password=filter_input(INPUT_POST, "password");
$email=filter_input(INPUT_POST, "email");
$contacto=filter_input(INPUT_POST, "contacto");
$iniciais=filter_input(INPUT_POST, "iniciais");
$cor=filter_input(INPUT_POST, "cor");
$voip=filter_input(INPUT_POST, "voip");
$nlugares=filter_input(INPUT_POST, "nlugares");
$partida=filter_input(INPUT_POST, "partida");
$destino=filter_input(INPUT_POST, "destino");
if($voip==""){
    $voip="null";
}
if($contacto==""){
    $contacto="null";
}

$query = "call InserirUtilizador('$nome','$password','$email',$contacto,'$iniciais','$cor',$voip,$nlugares,'$partida','$destino')";
$result = ligacao($query);
$count = $result->rowCount();
if($count == 0){
    echo "delimitador6/Ocorreu um erro.";
    exit;
}
