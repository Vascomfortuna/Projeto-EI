<?php
include './functions.php';
$nPara = 5;
$dataini=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataini")));
$datarep=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataini")));
$dataf=  date('Y-m-d', strtotime(filter_input(INPUT_POST, "dataf")));
$horaini = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaini")));
$horaf = date("H:i:s",strtotime(filter_input(INPUT_POST, "horaf")));
$rep = filter_input(INPUT_POST, "rep");
$idboleia= filter_input(INPUT_POST, "idboleia");
$datediff = abs(strtotime($dataf) - strtotime($dataini))/86400;
$distrib=filter_input(INPUT_POST, "distrib");
if($distrib){
    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $len = (count($p) / $nPara);
    $d= array();
    for($i=0;$i<$len;$i++){
          $d[$i]=$p[($i*$nPara)+1];     
    }
$c=0;
}
if($rep==0){
    $updateboleia = "update boleias SET boleias_idboleia=$idboleia, repeticaoinicio = '$dataini', repeticaofim = '$dataf', nsemanarep='*', ndiarep='*' where idboleia= $idboleia";
    ligacao($updateboleia);
    for($i = 0; $i <= $datediff;$i++){
    if($distrib && $c!=-1){
        $cond=$d[$c];
    }else{
        $cond=$_SESSION['idutilizador'];
    }
    $query2 = "CALL InserirBoleia('$datarep','$horaini','$horaf',".$cond.",$idboleia,'$dataini',$dataf,'*','*')";
    ligacao($query2);
    $datarep=  date('Y-m-d', strtotime($datarep . ' +1 day'));
    if($c<$len-1){
        $c++;
    }else{
        $c=-1;
    }
    }
} else if ($rep==1){
    $dia=date('w', strtotime($dataini));
     $updateboleia = "update boleias SET boleias_idboleia=$idboleia, repeticaoinicio = '$dataini', repeticaofim = '$dataf', nsemanarep='*', ndiarep='$dia' where idboleia= $idboleia";
    ligacao($updateboleia);
    for($i = 0; $i <= $datediff;$i=$i+7){ 
        if($distrib && $c!=-1){
        $cond=$d[$c];
    }else{
        $cond=$_SESSION['idutilizador'];
    } 
    $query2 = "CALL InserirBoleia('$datarep','$horaini','$horaf',".$cond.",$idboleia,'$dataini',$dataf,'*','$dia')";
    ligacao($query2);
    $datarep=  date('Y-m-d', strtotime($datarep . ' +1 week'));
    if($c<$len-1){
        $c++;
    }else{
        $c=-1;
    }
    }

}