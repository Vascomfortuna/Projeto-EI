<?php

include "./functions.php";
$idboleia=filter_input(INPUT_POST, "idboleia");
$partida=filter_input(INPUT_POST, "partida");
$destino=filter_input(INPUT_POST, "destino");
$horaini = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaini")));
$horaf = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaf")));
$nlugares = filter_input(INPUT_POST, "nlugares");
if (empty($nlugares)) {
    $nlugares = 4;
} 
$query = "UPDATE boleias SET partida='$partida', destino='$destino', horainicio='$horaini', horafim='$horaf', nlugares=$nlugares where idboleia = $idboleia";
$result = ligacao($query);
if(mysql_num_rows($result) == 0){
    echo "delimitador/Password errada.";
    exit;
}
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }


