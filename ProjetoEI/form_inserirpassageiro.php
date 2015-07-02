<?php

include "./functions.php";
$idboleia = (filter_input(INPUT_POST, "idboleia"));
$idutilizador = $_SESSION['idutilizador'];
$nota = filter_input(INPUT_POST, "nota");
$vu = filter_input(INPUT_POST, "vu");
if (empty($nota)) {
    $nota = "null";
} else {
    $nota = "'$nota'";
}
$query = "select idutilizador,idboleia from passageiros where idboleia=$idboleia and idutilizador=$idutilizador";
$result = ligacao($query);
if (is_resource($result) || !($result) || empty($result)) {

    $query2 = "insert into passageiros (idutilizador,idboleia,nota,ViagemUnica) "
            . "VALUES ('$idutilizador','$idboleia',$nota,$vu)";
    echo $query2;
    $result2 = ligacao($query2);
    if (!$result2) {
        echo "<br/>Ocorreu um erro na query 2<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    } else {
        echo "sucess;";
    }
} else {
    $query2 = "update passageiros SET ativo = 1, nota=$nota , ViagemUnica=$vu where "
            . " idutilizador=$idutilizador and idboleia=$idboleia";
    $result2 = ligacao($query2);
    if (!$result2) {
        echo "<br/>Ocorreu um erro na query3<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    } else {
        echo "sucess;";
    }
}
        

