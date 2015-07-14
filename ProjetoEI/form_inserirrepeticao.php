<?php
include './functions.php';
$dataini=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataini")));
$datarep=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataini")));
$dataf=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataf")));
$horaini = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaini")));
$horaf = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaf")));
$rep = filter_input(INPUT_POST, "rep");
$idboleia= filter_input(INPUT_POST, "idboleia");
$datediff = abs(strtotime($dataf) - strtotime($dataini))/86400;
echo ($datarep." ".$dataini." ".$dataf." ". $datediff);
if($rep==0){
    $updateboleia = "update boleias SET boleias_idboleia=$idboleia, repeticaoinicio = '$dataini', repeticaofim = '$dataf', nsemanarep='*', ndiarep='*' where idboleia= $idboleia";
    ligacao($updateboleia);
    for($i = 0; $i <= $datediff;$i++){
    $query2 = "CALL InserirBoleia('$datarep','$horaini','$horaf',".$_SESSION['idutilizador'].",$idboleia,'$dataini',$dataf,'*','*')";
    ligacao($query2);
    $datarep=  date('Y-m-d', strtotime($datarep . ' +1 day'));
    }
}