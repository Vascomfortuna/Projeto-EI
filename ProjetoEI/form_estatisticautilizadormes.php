<?php
include "./functions.php";
$idutilizador=  filter_input(INPUT_POST, 'idutilizador');
$mes=  filter_input(INPUT_POST, 'mes');
$ano=  filter_input(INPUT_POST, 'ano');

$query= "select ifnull(sum(NCondutor),0) as nc,ifnull(sum(NPassageiro),0) as np,ifnull(sum(NPessoasLevadas),0) as npl from estatisticas where idutilizador=$idutilizador and month(mes)=$mes and year(mes)=$ano";
$result=  ligacao($query);
if(!$result){
    echo "delimitador10/Ocorreu um erro.";
}else {
    echo "delimitador10/".
            $r="";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<table class='table table-bordered'><tr><td>Nº de vezes que foi condutor: ".$row['nc']
                    ."</td></tr><tr><td>Nº de vezes que foi passageiro: ".$row['np']
                    ."</td></tr><tr><td>Nº de pessoas que levou: " .$row['npl']
                    ."</td></tr></table>";
            }
}
