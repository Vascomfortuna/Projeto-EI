
<script>
   

    function Aparecer(id) {
        
        h = document.getElementById(id);

        if (h.getAttribute("hidden") === null) {
            h.setAttribute("hidden", "");
        } else if (h.getAttribute("hidden") === "") {
            h.removeAttribute("hidden");
        }
        
    }

    function mapaBoleia()
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("divmapa").innerHTML = xmlhttp.responseText;
            }

            

        };
        xmlhttp.open("GET", "form_mapaboleia.php", true);
            xmlhttp.send();
    }

</script>

<?php

function CriarBoleia($id) {
    echo "<div  id=\"$id\" class=\"criarboleia container\" hidden >
                <table>
                    <tr><td>Condutor:</td><td>
                    <select>
                    <option>João</option>
                    </select></td></tr>
                    <tr><td>Destino:</td><td>
                    <input type='text' style='width:95%'/></td></tr>
                    <tr><td><button>OK</button></td><td><button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function ColocarBoleia($id, $cor, $nome) {
    echo "<div  id=\"$id\" style=\"background-color:$cor\" class=\"criarboleia container\" hidden >
                <table>
                    <tr><td>Condutor:$nome</td><td>
                    <select>
                    <option>João</option>
                    </select></td></tr>                
                    <tr><td></td><td><button onclick=Aparecer('$id')>Fechar</button></td></tr>
                </table>
              </div>";
}

function ligacao($query) {
    $ligacao = mysql_connect("localhost", "root", "");
    if (!$ligacao) {
        die("nao foi possivel ligar:" . mysql_error());
    }
    mysql_select_db("mydb");
    $result = mysql_query($query, $ligacao);
    return $result;
}

function BuscarMembros() {
    $bmembros = "select nome,cor from utilizadores";
    try {
        $result = ligacao($bmembros);
        if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        $r = "";
        while ($row = mysql_fetch_assoc($result)) {
            $r.=$row['cor'] . "," . $row['nome'] . ",";
        }
        return $r;
    } catch (PDOException $e) {
        die($e);
    }
}

function BuscarBoleias($dia, $horai, $horaf, $dsemana) {
    $bboleias = "select b.horafim,u.nome,u.iniciais,u.cor from boleias b "
            . "inner join utilizadores u on b.idutilizador=u.idutilizador "
            . "where b.data='$dia' "
            . "and '$horai'>=b.horainicio "
            . "and '$horaf'<=b.horafim "
            . "and $dsemana=b.diasemana "
            . "order by b.idBoleia "           
."asc";
    $result = ligacao($bboleias);
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.=$row['cor'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . ",";
    }
    
    return $r;
}

function BuscarSobrepostas($dia, $horai, $horaf, $dsemana) {
    $bsobre = "select b.horainicio,b.horafim,u.nome,u.iniciais,u.cor from boleias b "
            . "inner join utilizadores u on b.idutilizador=u.idutilizador "
            . "where b.data='$dia' "
            . "and '$horai'<=b.horainicio "
            . "and '$horaf'>b.horainicio "
            . "and $dsemana=b.diasemana"
            . " order by b.idBoleia"           
." asc limit 1,18446744073709551615";
    $result = ligacao($bsobre);
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.=$row['cor'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . ",". $row['horainicio'] . ",";
    }
    
    return $r;
}

function ContarEspacos($horai, $horaf) {
    $time_array = explode(':', $horai);
    $time_arrayf = explode(':', $horaf);
    $x = ($time_arrayf[0]-$time_array[0])*2;
    if($time_array[1]>$time_arrayf[1]){
        $x--;
    }else if ($time_array[1]<$time_arrayf[1]){
        $x++;
    }
    if($x<0){
       $x=0;
    }
    return $x;
}
