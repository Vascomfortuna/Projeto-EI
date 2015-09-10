<?php

include "./functions.php";
$idutilizador = (filter_input(INPUT_POST, "idutilizador"));

$query0 = "delete from alteracoes where "
        . "idutilizador=$idutilizador";
$result0 = ligacao($query0);

if (!$result0) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}

$query = "delete from passageiros where "
        . "idutilizador=$idutilizador";
$result = ligacao($query);

if (!$result) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}

$query2 = "delete from boleias where "
        . "idutilizador=$idutilizador";
$result2 = ligacao($query2);

if (!$result2) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}

$query3 = "delete from estatisticas where "
        . "idutilizador=$idutilizador";
$result3 = ligacao($query3);

if (!$result3) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}


$query4 = "delete from configuracoes where "
        . "idutilizador=$idutilizador";
$result4 = ligacao($query4);

if (!$result4) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}

$query5 = "delete from utilizadores where "
        . "idutilizador=$idutilizador";
$result5 = ligacao($query5);

if (!$result5) {
    echo "delimitador8/<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}
        

        

        

