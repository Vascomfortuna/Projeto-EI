<?php
include './functions.php';
//error_reporting(0);
$dias = array(0, 0, 0, 0, 0, 0);
$startdate = filter_input(INPUT_GET, "d");
date_default_timezone_set("Portugal");
if ($startdate == null) {
    $startdate = strtotime("Monday");
    if ($startdate > strtotime("today")) {
        $startdate = strtotime("-1 week", $startdate);
    }
}
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
                    echo "<tr><th>" . date("H:i", $h1) . "-" . date("H:i", $h2) . "</th>";
                } else {
                    echo "</tr><tr><th>" . date("H:i", $h2) . "-" . date("H:i", $h3) . "</th>";
                }
                for ($i = 0; $i < 6; $i++) {
                    if($y==0){
                    $haux1=date('H:i:s', $h1);
                    $haux2=date('H:i:s', $h2);
                    }else{
                       $haux1=date('H:i:s', $h2);
                    $haux2=date('H:i:s', $h3); 
                    }
                    if ($dias[$i] == 0) {
                        $rown = 0;
                        
                            $boleia = explode(",", BuscarBoleias(
                                            date('Y-m-d', strtotime("+$i day", $startdate)), $haux1, $haux2
                                            , (2 + $i)), -1);
                        
                        
                        if (empty($boleia)) {
                            echo"<td ><div class=\"espaco\" onclick=\"Aparecer('hid$z')\"></div>";
                            CriarBoleia("hid$z");
                        } else {
                            $sobre = explode(",", BuscarSobrepostas(
                                            date('Y-m-d', strtotime("+$i day", $startdate)), date('H:i:s', $h1), $boleia[1]
                                            , (2 + $i)), -1);
                            if (!empty($sobre)) {
                                $len = (count($sobre) / 5);
                                for ($j = 0; $j < $len; $j++) {
                                    if ($sobre[1+(5*$j)] > $boleia[1]) {
                                        $aux = ContarEspacos($haux1, $sobre[1+(5*$j)]);
                                    } else {
                                        $aux = ContarEspacos($haux1, $boleia[1]);
                                    }
                                    if($aux>$rown){
                                        $rown=$aux;
                                    }
                                    $rownstart[$j]= ContarEspacos($haux1,$sobre[4+(5*$j)]);
                                }
                                echo " dfhjk ". $rownstart[0] ;
                                if ($rown > 1) {
                                $dias[$i] = $rown - 1;
                                }
                                 if ($y == 0) {
                                        $he1 = ContarEspacos(date('H:i:s', $h1), $boleia[1])*50;
                                    } else {
                                        $he1 = ContarEspacos(date('H:i:s', $h2), $boleia[1])*50;
                                    }
                                        $he2 = ContarEspacos($sobre[4], $sobre[1])*50;
                                $w=(50*($len+1));
                                echo"<td rowspan=\"$rown\">" .
                                "<table class=\"table-bordered\"><tr><td class=\"vtop\">";
                                echo"<div  onclick=\"Aparecer('hid$z')\" style=\"height:$he1"."px; width:$w"."px; background-color:$boleia[0]\" >$rown</div>";
                                ColocarBoleia("hid$z", $boleia[0], $boleia[3]);
                                
                                $z++;
                                echo "</td>";
                                for ($t = 0; $t < $len; $t++) {
                                    echo "<td class=\"vtop\" ><div style=\"width:$w"."px; height:".($rownstart[$t]*50)."px\"></div>";
                                    echo "<div  style=\"width:$w"."px; height:$he2"."px; background-color:"
                                            . $sobre[0 + (5 * $t)]
                                            ."\" onclick=\"Aparecer('hid$z')"
                                            ."\" >$rown</div>";
                                    ColocarBoleia("hid$z", $sobre[0 + (5 * $t)], $sobre[3 + (5 * $t)]);
                                    $z++;
                                    echo "</td>";
                                }
                                echo "</tr></table>";
                            }else{
                            $rown = ContarEspacos(date('H:i:s', $h1), $boleia[1]);
                            if ($rown > 1) {
                                $dias[$i] = $rown - 1;
                            }
                            echo"<td rowspan=\"$rown\">"
                            . "<div class=\"espaco\" onclick=\"Aparecer('hid$z')\" style=\"background-color:$boleia[0]\" ></div>";
                            ColocarBoleia("hid$z", $boleia[0], $boleia[3]);
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