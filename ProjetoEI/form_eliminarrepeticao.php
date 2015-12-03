<?php

include "./functions.php";
$idboleia = (filter_input(INPUT_POST, "idboleia"));
$idrep = (filter_input(INPUT_POST, "idrep"));

$query3= "delete p.* from passageiros p inner join boleias b on p.idboleia=b.idboleia where b.boleias_idboleia=$idrep and b.idboleia!=$idrep;";
$result3 = ligacao($query3);
if (!$result3) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
$query = "delete from boleias where boleias_idboleia=$idrep and idboleia!=$idrep";
$result = ligacao($query);
if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
$query4= "delete p.* from passageiros p inner join boleias b on p.idboleia=b.idboleia where b.idboleia=$idrep;";
$result4 = ligacao($query4);
if (!$result3) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }      
$query2 = "update boleias SET ativo=0 where idboleia=$idrep";
$result2 = ligacao($query2);


if (!$result2) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }else{
            echo "sucess;";
        }
        
