<?php
include "./functions.php";
echo "/delimitador5";
$hora = date("H:i:s",strtotime(filter_input(INPUT_POST, "hora")));
$horaf = date('H:i:s',strtotime("+30 minutes", strtotime($hora)));
$dia = filter_input(INPUT_POST, "dia");
$query = "insert into boleias (horainicio,horafim,data,idUtilizador,DiaSemana) "
        . "VALUES ('$hora','$horaf','$dia',".$_SESSION['idutilizador'].",dayofweek('$dia'))";
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        

