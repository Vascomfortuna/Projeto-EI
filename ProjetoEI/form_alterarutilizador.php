<?php

include "./functions.php";
$email = $_SESSION['email'];
$password = filter_input(INPUT_POST, "password");
$nome = utf8_decode(filter_input(INPUT_POST, "nome"));
$contacto = filter_input(INPUT_POST, "contacto");
$iniciais = filter_input(INPUT_POST, "iniciais");
$voip = filter_input(INPUT_POST, "voip");
$partida = filter_input(INPUT_POST, "partida");
$destino = filter_input(INPUT_POST, "destino");
$cor = filter_input(INPUT_POST, "cor");
if(empty($nlugares)){
    $nlugares=4;
}
if(empty($cor)){
    $cor=$_SESSION['cor'];
}
if(empty($voip)){
    $voip="null";
}
if(empty($contacto)){
    $contacto="null";
}
if(empty($nome)){
    $nlugares=$_SESSION['nome'];
}
if(empty($iniciais)){
    $iniciais=$_SESSION['iniciais'];
}
if(empty($partida)){
    $partida="";
}
if(empty($destino)){
    $destino="";
}

$query = "UPDATE utilizadores SET partida='$partida', destino='$destino', contacto='$contacto', nome='$nome', nlugares=$nlugares, "
        . "iniciais='$iniciais', voip=$voip, cor='$cor' "
        . "where email = '$email' and password='$password';";

$result = ligacao($query);
$count = $result->rowCount();
if($count==0) {
    echo "delimitador2/Password errada.";
}
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "delimitador2/Alteração efetuada.;";
        }

if(($result) == false){
    echo "delimitador2/Password errada.";
    exit;
}   else{    
        $_SESSION["nome"] = utf8_encode ($nome);
        $_SESSION["iniciais"] = $iniciais;
        $_SESSION["cor"] = $cor;
        $_SESSION["contacto"] = $contacto;
        $_SESSION["voip"] = $voip;
        $_SESSION["nlugares"] = $nlugares;
        $_SESSION["partida"] = $partida;
        $_SESSION["destino"] = $destino;
    }


