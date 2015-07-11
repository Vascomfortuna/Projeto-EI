<?php
include './functions.php';
//error_reporting(0);
$nPara = 10;
$dias = array(0, 0, 0, 0, 0, 0);
$startdate = filter_input(INPUT_COOKIE, "d");
date_default_timezone_set("Portugal");
if ($startdate == null) {
    $startdate = strtotime("Monday");
    if ($startdate > strtotime("today")) {
        $startdate = strtotime("-1 week", $startdate);
    }
    
}
echo $startdate;
?>

<html>

    <h2>Mapa da semana <?php echo date("M d", $startdate) . " - " . date("M d", strtotime("+1 week", $startdate)); ?></h2>
    <table class="table table-bordered table-condensed mapaboleia">
        <tr>
            <th>Hora</th>
            <th>Segunda</th>
            <th>Terça</th>
            <th>Quarta</th>
            <th>Quinta</th>
            <th>Sexta</th>
            <th>Sábado</th>
        </tr>
        <?php
        $z = 0;
        for ($x = 7; $x <= 22; $x++) {
            $h1 = strtotime("$x:00");
            $h2 = strtotime("$x:30");
            $h3 = strtotime(($x + 1) . ":00");
            for ($y = 0; $y < 2; $y++) {
                if ($y == 0) {
                    echo "<tr><th>" . date("H:i", $h1) . "</th>";
                } else {
                    echo "</tr><tr><th>" . date("H:i", $h2)  . "</th>";
                }
                for ($i = 0; $i < 6; $i++) {
                    $dia=date('Y-m-d', strtotime("+$i day", $startdate));
                    $diasemana = (2 + $i);
                    if($y==0){
                    $haux1=date('H:i:s', $h1);
                    $haux2=date('H:i:s', $h2);
                    }else{
                    $haux1=date('H:i:s', $h2);
                    $haux2=date('H:i:s', $h3); 
                    }
                    if ($dias[$i] == 0) {
                        $rown = 0;
                            //Vai buscar primeira boleia
                            $boleia = explode(",", BuscarBoleias(
                                            $dia, $haux1, $haux2
                                            , $diasemana,0), -1);
                        
                        //Se encontrar boleias
                        if (empty($boleia)) {
                            echo"<td ><div class=\"espaco\" onclick=\"Aparecer('hid$z')\"></div>";
                            CriarBoleia("hid$z",$haux1,$dia);
                        } else {
                            //Vai buscar boleias sobrepostas
                            $sobre = explode(",", BuscarBoleias(
                                            $dia, $haux1, $boleia[1]
                                            , $diasemana ,1), -1);
                            //Se encontrar sobrepostas
                            if (!empty($sobre)) {
                                $len = (count($sobre) / $nPara);
                                for ($j = 0; $j < $len; $j++) {
                                    $cont = ($nPara * $j);
                                    if ($sobre[1+$cont] > $boleia[1]) {
                                        $aux = ContarEspacos($haux1, $sobre[1+$cont]);
                                    } else {
                                        $aux = ContarEspacos($haux1, $boleia[1]);
                                    }
                                    if($aux>$rown){
                                        $rown=$aux;
                                    }
                                    $rownstart[$j]= ContarEspacos($haux1,$sobre[0+$cont]);
                                }
                                if ($rown > 1) {
                                $dias[$i] = $rown - 1;
                                }
                                 $he1 = ContarEspacos($haux1, $boleia[1])*55;
                                        $he2 = ContarEspacos($sobre[0+$cont], $sobre[1+$cont])*55;
                                $w=(50*($len+1));
                                echo"<td rowspan=\"$rown\">" .
                                "<table class=\"table-bordered\" ><tr><td class=\"vtop\">";
                                echo"<div  onclick=\"Aparecer('hid$z')\" style=\"height:$he1"."px; width:$w"."px; background-color:$boleia[4]\" >";
                                DadosBoleia($boleia[8], $boleia[2]);
                                echo "</div>";
                                ColocarBoleia("hid$z", $boleia[3], $boleia[4],$boleia[5],$boleia[6],$boleia[7],$boleia[8],$boleia[9],$boleia[0],$boleia[1]);
                                
                                $z++;
                                echo "</td>";
                                for ($t = 0; $t < $len; $t++) {
                                    $cont = ($nPara * $t);
                                    echo "<td class=\"vtop\" ><div style=\"width:$w"."px; height:".($rownstart[$t]*55)."px\"></div>";
                                    echo "<div  style=\"width:$w"."px; height:$he2"."px; background-color:"
                                            . $sobre[4 + $cont]
                                            ."\" onclick=\"Aparecer('hid$z')"
                                            ."\">";
                                    DadosBoleia($sobre[8 + $cont], $sobre[2 + $cont]);
                                    echo "</div>";
                                    ColocarBoleia("hid$z", $sobre[3 + $cont], $sobre[4 + $cont],$sobre[5 + $cont],$sobre[6 + $cont],$sobre[7 + $cont],$sobre[8 + $cont],$sobre[9 + $cont],$sobre[0 + $cont],$sobre[1 + $cont]);
                                    $z++;
                                    echo "</td>";
                                }
                                echo "</tr></table>";
                            }else{
                                $he1 = ContarEspacos($haux1, $boleia[1])*55;
                            $rown = ContarEspacos(date('H:i:s', $h1), $boleia[1]);
                            if ($rown > 1) {
                                $dias[$i] = $rown - 1;
                            }
                            echo"<td rowspan=\"$rown\">"
                            . "<div class=\"espaco\" onclick=\"Aparecer('hid$z')\" style=\"height:$he1"."px; background-color:$boleia[4]\" >";
                            DadosBoleia($boleia[8], $boleia[2]);
                            echo "</div>";
                            ColocarBoleia("hid$z", $boleia[3], $boleia[4],$boleia[5],$boleia[6],$boleia[7],$boleia[8],$boleia[9],$boleia[0],$boleia[1]);
                            }
                        }
                        echo "</td>";
                        $z++;
                    } else {
                        $dias[$i] --;
                    }
                }
                echo "</tr>";
            }
        }
        ?>
    </table>
</html>