<?php
include "./functions.php";
$hora = date("H:i:s",strtotime(filter_input(INPUT_POST, "hora")));
$horaf = date('H:i:s',strtotime("+30 minutes", strtotime($hora)));
$dia = filter_input(INPUT_POST, "dia");
$query = "call InserirBoleiaS('$dia','$hora','$horaf',".$_SESSION['idutilizador'].")";
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "success";
        
        }
        

