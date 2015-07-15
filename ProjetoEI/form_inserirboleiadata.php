<?php
include "./functions.php";
echo "/delimitador5";
$horaini = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaini")));
$horaf = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaf")));
$data = date("Y-m-d",strtotime(filter_input(INPUT_POST, "data")));
$query = "insert into boleias (horainicio,horafim,data,idutilizador,DiaSemana) "
        . "VALUES ('$horaini','$horaf','$data',".$_SESSION['idutilizador'].",dayofweek('$data'))";
echo $query;
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        

