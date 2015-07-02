<?php

include "./functions.php";
$idboleia = (filter_input(INPUT_POST, "idboleia"));

$query = "update boleias SET ativo=0 where "
        . "idboleia=$idboleia";
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        
