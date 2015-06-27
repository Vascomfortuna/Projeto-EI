<?php session_start(); ?>
<script>

    function Login(email, password)
    {
        str = "email=" + email + "&password=" + password;
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
                msg = xmlhttp.responseText.split("delimitador/");
                if (typeof msg[2] !== 'undefined') {
                    document.getElementById("msg").innerHTML = msg[2];
                } else {
                    window.location = "./mapaboleia.php";
                }
            }
        };
        xmlhttp.open("POST", "form_login.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }

    function Logout()
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
                window.location = "./index.php";
            }
        };
        xmlhttp.open("GET", "form_logout.php", true);
        xmlhttp.send();
    }

    function Aparecer(id) {

        h = document.getElementById(id);

        if (h.getAttribute("hidden") === null) {
            h.setAttribute("hidden", "");
        } else if (h.getAttribute("hidden") === "") {
            h.removeAttribute("hidden");
        }

    }

    function MapaBoleia()
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

    function InserirBoleia(hora, dia, id)
    {
        var xmlhttp;
        str = "hora=" + hora + "&dia=" + dia + "&id=" + id;
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
                location.reload();
            }
        };
        xmlhttp.open("POST", "form_inserirboleia.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function InserirPassageiro(idboleia, idutilizador, nota, vu)
    {
        str = "idboleia=" + idboleia + "&idutilizador=" + idutilizador + "&vu=" + vu;
        if (nota !== "") {
            str += "&nota=" + nota;
        }
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
                alert(xmlhttp.responseText);
                location.reload();
            }
        };
        xmlhttp.open("POST", "form_inserirpassageiro.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    
    function EliminarPassageiro(idboleia, idutilizador)
    {
        if(confirm("Quer sair desta boleia?")){
        str = "idboleia=" + idboleia + "&idutilizador=" + idutilizador ;
        
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
                location.reload();
            }
        };
        xmlhttp.open("POST", "form_eliminarpassageiro.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    }




</script>

<?php

function OptionsMembros() {
    $query = "select idutilizador,nome from utilizadores";
    $result = ligacao($query);
    if (!$result) {
        echo "<br/>Ocorreu um erro na query<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.= "<option value=\"" . $row['idutilizador'] . "\">" . $row['nome'] . "</option>";
    }
    return $r;
}

function CriarPassageiro($id, $idboleia) {
    echo "<div  id=\"$id\" class=\"criarboleia container\" style=\"height:150px; width:340px; background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\">
                    <tr><td>Viagem:</td>
                    <td><select id=\"vu\">
                    <option value=\"0\">Ida e volta</option>
                    <option value=\"1\">Só ida</option>
                    <option value=\"2\">Só volta</option>
                </select></td></tr> 
                <tr><td>Nota(max:255):</td><td><textarea id=\"nota\"></textarea rows=\"2\" cols=\"25\" maxlength=\"255\"> </td></tr> 
                    <tr><td><button onclick=\"InserirPassageiro('$idboleia','" . $_SESSION['idutilizador'] . "',document.getElementById('nota').value,document.getElementById('vu').value);\">OK</button></td>"
    . "<td><button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function CriarBoleia($id, $hora, $dia) {

    $op = OptionsMembros();
    echo "<div  id=\"$id\" class=\"criarboleia container\" hidden >
                <table>
                    <tr><td>Condutor:</td><td><select id=\"nomeCondutor\">
                    $op</select></td></tr> 
                    <tr><td><button onclick=\"InserirBoleia('$hora','$dia',document.getElementById('nomeCondutor').value);\">OK</button></td>"
    . "<td><button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function ColocarBoleia($id, $nome, $cor, $partida, $destino, $nlugares, $idboleia) {
    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $len = count($p) / 2;
    $h = 250 + (50 * $len * 2);
    $pass = "";
    $colocar = true;
    for ($i = 0; $i < $len; $i++) {
        $pointer = $i * 2;
        $pass.="<tr><td><label>Passageiro " . ($i + 1) . ": " .utf8_encode($p[$pointer])."</label></td></tr>";
        if ($p[$pointer + 1] == $_SESSION['idutilizador']) {
            $colocar = false;
        }
    }
    echo "<div  id=\"$id\" style=\"background-color:$cor; height:$h" . "px;\" class=\"criarboleia container\" hidden >
                <table class = \"table-condensed table-bordered \" style=\"background-color:$cor\">
                    <tr><td>Condutor:". utf8_encode($nome)."</td></tr>"
    . "<tr><td>Partida: $partida</td></tr> "
    . "<tr><td>Destino: $destino</td></tr>"
    . "<tr><td>Lugares: $nlugares</td></tr>"
    . "<tr><td>Vagas: " . ($nlugares - $len) . "</td></tr>
  $pass";
    if ($colocar && (($nlugares - $len) > 0)) {
        echo "<tr><td><button onclick=Aparecer('pass$id')>Entrar</button>";
       CriarPassageiro("pass$id", $idboleia);
        echo "</td></tr>";
    } else if (!$colocar) {
        echo "<tr><td><button onclick=EliminarPassageiro($idboleia,".$_SESSION['idutilizador'].")>Sair</button></td></tr>";
    }
    echo "<tr><td><button onclick=Aparecer('$id')>Fechar</button></td></tr> </table> </div>";
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

function BuscarBoleias($dia, $horai, $horaf, $dsemana, $sobre) {
    if ($sobre == 0) {
        $bboleias = "select b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.nome,u.iniciais,u.cor,b.idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador "
                . "where b.data='$dia' "
                . "and '$horai'>=b.horainicio "
                . "and '$horaf'<=b.horafim "
                . "and $dsemana=b.diasemana "
                . "order by b.idboleia asc";
    } else {
        $bboleias = "select b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.nome,u.iniciais,u.cor,b.idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador " . "where b.data='$dia' " . "and '$horai'<=b.horainicio " . "and '$horaf'>b.horainicio " . "and $dsemana=b.diasemana" . " order by b.idboleia"
                . " asc limit 1,18446744073709551615";
    }
    $result = ligacao($bboleias);
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.= $row['horainicio'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . "," . $row['cor'] . ","
                . $row['partida'] . "," . $row['destino'] . "," . $row['nlugares'] . "," . $row['idboleia'] . ",";
    }

    return $r;
}

function BuscarSobrepostas($dia, $horai, $horaf, $dsemana) {
    $bsobre = "select b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.nome,u.iniciais,u.cor from boleias b "
            . "inner join utilizadores u on b.idutilizador=u.idutilizador "
            . "where b.data='$dia' "
            . "and '$horai'<=b.horainicio "
            . "and '$horaf'>b.horainicio "
            . "and $dsemana=b.diasemana"
            . " order by b.idBoleia"
            . " asc limit 1,18446744073709551615";
    $result = ligacao($bsobre);
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.=$row['cor'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . "," . $row['horainicio'] . ","
                . $row['partida'] . "," . $row['destino'] . "," . $row['nlugares'] . "," . $row['idboleia'] . ",";
    }

    return $r;
}

function ContarEspacos($horai, $horaf) {
    $time_array = explode(':', $horai);
    $time_arrayf = explode(':', $horaf);
    $x = ($time_arrayf[0] - $time_array[0]) * 2;
    if ($time_array[1] > $time_arrayf[1]) {
        $x--;
    } else if ($time_array[1] < $time_arrayf[1]) {
        $x++;
    }
    if ($x < 0) {
        $x = 0;
    }
    return $x;
}

function BuscarPassageiros($idboleia) {
    $query = "select u.nome,u.idutilizador from utilizadores u inner join passageiros p on u.idutilizador=p.idutilizador where p.idboleia=$idboleia and ativo=1";
    $result = ligacao($query);
    if (!$result) {
        echo "<br/>Ocorreu um erro na query<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.= $row['nome'] . "," . $row['idutilizador'] . ",";
    }
    return $r;
}
