<?php
include "./functions.php";
$hora = date("H:i:s",strtotime(filter_input(INPUT_POST, "hora")));
$horaf = date('h:i:s',strtotime("+30 minutes", strtotime($hora)));
$dia = filter_input(INPUT_POST, "dia");
$id = filter_input(INPUT_POST, "id");
echo "$hora,$horaf,$dia,$id";
$query = "insert into boleias (horainicio,horafim,data,idUtilizador,DiaSemana) "
        . "VALUES ('$hora','$horaf','$dia',$id,dayofweek('$dia'))";
echo $query;
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        

