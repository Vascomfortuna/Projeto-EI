<?php

include "./functions.php";
$dia = filter_input(INPUT_POST, "dia");
$mes = filter_input(INPUT_POST, "mes");
$ano = filter_input(INPUT_POST, "ano");
$id = filter_input(INPUT_POST, "id");

$str = CriarDataOpcoes($dia, $mes, $ano);

$select = "<select id=\"dia$id\">$str[0]</select><select onchange=\"ColocarData('$id');\" id=\"mes$id\">$str[1]</select><select id=\"ano$id\" onchange=\"ColocarData('$id');\">$str[2]</select>";

echo "delimitador3/$select";