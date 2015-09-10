<?php
include "./functions.php";
$idutilizador = $_SESSION['idutilizador'];
$desc = filter_input(INPUT_POST, "descricao");
$nota = filter_input(INPUT_POST, "nota");

$alt = "call InserirAlteracao('$desc',$idutilizador,'$nota');";
$result = ligacao($alt);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }