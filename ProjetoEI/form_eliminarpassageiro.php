<?php

include "./functions.php";
$idboleia = (filter_input(INPUT_POST, "idboleia"));
$idutilizador = (filter_input(INPUT_POST, "idutilizador"));

$query = "update passageiros SET ativo=0 where "
        . " idutilizador= $idutilizador and idboleia=$idboleia";
$result = ligacao($query);
echo $query;
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        
