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
                var msg = xmlhttp.responseText.split("delimitador/");
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
    function AlterarUtilizador()
    {
        var xmlhttp;
        str = "&partida=" + document.getElementById("partida").value + "&destino=" + document.getElementById("destino").value
                + "&voip=" + document.getElementById("voip").value + "&nome=" + document.getElementById("nome").value + "&nlugares="
                + document.getElementById("nlugares").value + "&contacto=" + document.getElementById("contacto").value
                + "&cor=" + document.getElementById("cor").value
                + "&password=" + document.getElementById("password").value;
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
                var x = xmlhttp.responseText.split("delimitador2/");
                if (typeof x[2] !== 'undefined') {
                    document.getElementById("divmsg").innerHTML = x[2];
                } else {
                    document.getElementById("divmsg").innerHTML = "Alteração efectuada.";
                }
            }
        };
        xmlhttp.open("POST", "form_alterarutilizador.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }

    function MapaBoleia(data)
    {
        if (typeof data != "undefined") {
            document.cookie = "d=" + data;
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
                document.getElementById("divmapa").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "form_mapaboleia.php", true);
        xmlhttp.send();
    }

    function InserirBoleia(hora, dia)
    {
        var xmlhttp;
        str = "hora=" + hora + "&dia=" + dia;
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
    function AlterarBoleia(id, idboleia)
    {
        var xmlhttp;
        horaini = "" + document.getElementById("horaini" + id).value + document.getElementById("minini" + id).value;
        horaf = "" + document.getElementById("horaf" + id).value + document.getElementById("minf" + id).value;
        str = "idboleia=" + idboleia + "&partida=" + document.getElementById("p" + id).value + "&destino=" + document.getElementById("d" + id).value
                + "&horaini=" + horaini + "&horaf=" + horaf + "&nlugares=" + document.getElementById("nl" + id).value;
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
        xmlhttp.open("POST", "form_alterarboleia.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function EliminarOpcao(idboleia, rep) {
        if (rep == '') {
            EliminarBoleia(idboleia);
        } else if (confirm("Esta boleia faz parte de uma repetição. Quer eliminar todas as boleias associadas?")) {
            EliminarRepeticao(idboleia, rep);
        } else {
            EliminarBoleia(idboleia);
        }
    }
    function EliminarBoleia(idboleia)
    {
        if (confirm("Quer eliminar esta boleia?")) {
            var xmlhttp;
            str = "idboleia=" + idboleia;
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
            xmlhttp.open("POST", "form_eliminarboleia.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("" + str);
        }
    }
    function EliminarRepeticao(idboleia, idrep)
    {

        var xmlhttp;
        str = "idboleia=" + idboleia + "&idrep=" + idrep;
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
        xmlhttp.open("POST", "form_eliminarrepeticao.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);

    }
    function InserirPassageiro(idboleia, nota, vu)
    {
        str = "idboleia=" + idboleia + "&vu=" + vu;
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
                location.reload();
            }
        };
        xmlhttp.open("POST", "form_inserirpassageiro.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function InserirRep(dataini, dataf, horaini, horaf, rep, idboleia)
    {

        str = "dataini=" + dataini + "&dataf=" + dataf + "&horaini=" + horaini + "&horaf=" + horaf + "&rep=" + rep + "&idboleia=" + idboleia;
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
        xmlhttp.open("POST", "form_inserirrepeticao.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }


    function EliminarPassageiro(idboleia, idutilizador)
    {
        if (confirm("Quer sair desta boleia?")) {
            str = "idboleia=" + idboleia;

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
    function InserirBoleiaData(data,id){
        var xmlhttp;
        horaini = "" + document.getElementById("horaini" + id).value + document.getElementById("minini" + id).value;
        horaf = "" + document.getElementById("horaf" + id).value + document.getElementById("minf" + id).value;
        str = "horaini=" + horaini + "&horaf=" + horaf + "&data="+data;
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
                var x = xmlhttp.responseText.split("/delimitador5");
                alert(x[2]);
                location.reload();
            }
        };
        xmlhttp.open("POST", "form_inserirboleiadata.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function ColocarData(id)
    {
        var xmlhttp;

        var dia = document.getElementById("dia" + id);
        if (dia === null) {
            d = new Date();
            diaf = d.getDate();
            mesf = d.getMonth() + 1;
            anof = d.getFullYear();
        } else {
            diaf = document.getElementById("dia" + id).value;
            mesf = document.getElementById("mes" + id).value;
            anof = document.getElementById("ano" + id).value;
        }

        str = "id=" + id + "&dia=" + diaf + "&mes=" + mesf + "&ano=" + anof;
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
                var x = xmlhttp.responseText.split("delimitador3/");
                document.getElementById(id).innerHTML = x[2];
            }
        };
        xmlhttp.open("POST", "form_criardata.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ')
                c = c.substring(1);
            if (c.indexOf(name) == 0)
                return c.substring(name.length, c.length);
        }
        return "";
    }
    function BuscarData(id) {

        var dia = document.getElementById("dia" + id).value;
        var mes = document.getElementById("mes" + id).value;
        var ano = document.getElementById("ano" + id).value;
        var dat = ano + "-" + mes + "-" + dia;
        alert(dat);
        return dat;

    }
    
    
    function EliminarOpcao(idboleia, rep) {
        if (rep == '') {
            EliminarBoleia(idboleia);
        } else if (confirm("Esta boleia faz parte de uma repetição. Quer eliminar todas as boleias associadas?")) {
            EliminarRepeticao(idboleia, rep);
        } else {
            EliminarBoleia(idboleia);
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

function CriarDataOpcoes($dia, $mes, $ano) {
    $opdia = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
    $str = ["", "", ""];
    for ($i = 1; $i <= $opdia; $i++) {
        if ($i != $dia) {
            $str[0] .= "<option value=\"$i\">$i</option>";
        } else {
            $str[0] .= "<option selected value=\"$i\">$i</option>";
        }
    }
    for ($i = 1; $i <= 12; $i++) {
        if ($i != $mes) {
            $str[1] .= "<option value=\"$i\">$i</option>";
        } else {
            $str[1] .= "<option selected value=\"$i\">$i</option>";
        }
    }
    for ($i = 2000; $i <= 2050; $i++) {
        if ($i != $ano) {
            $str[2] .= "<option value=\"$i\">$i</option>";
        } else {
            $str[2] .= "<option selected value=\"$i\">$i</option>";
        }
    }
    return $str;
}

function CriarPassageiro($id, $idboleia) {
    echo "<div  id=\"$id\" class=\"criarboleia container\" style=\"height:150px; width:340px; background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\">
                    <tr><td>Viagem:</td>
                    <td><select id=\"vu$id\">
                    <option selected value=\"0\">Ida e volta</option>
                    <option value=\"1\">Só ida</option>
                    <option value=\"2\">Só volta</option>
                </select></td></tr> 
                <tr><td>Nota(max:255):</td><td><textarea id=\"nota$id\"></textarea rows=\"2\" cols=\"25\" maxlength=\"255\"> </td></tr> 
                    <tr><td><button onclick=\"InserirPassageiro('$idboleia',document.getElementById('nota$id').value,document.getElementById('vu$id').value);\">OK</button></td>"
    . "<td><button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function CriarRepeticao($id, $suf, $horaini, $horaf, $idboleia) {
    echo "<tr><td><button onclick=\"ColocarData('ini$suf$id');ColocarData('fim$suf$id');Aparecer('r$id');\">Repetir</button>"
    . "<div id=\"r$id\" class=\"criarboleia container\" style=\"height:150px; width:340px; background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\">
                    <tr><td>Data de início:</td><td id=\"ini$suf$id\"></td></tr>
                    <tr><td>Data de fim:</td><td id=\"fim$suf$id\"></td></tr>
                    <tr><td>Período</td><td><select id=\"rep$suf$id\"><option value=\"0\">Diariamente</option><option value=\"1\">Semanalmente</option value=\"2\"><option>Mensalmente</option></select></td></tr>
                    <tr><td><button onclick=\"var a = BuscarData('ini$suf$id'); var b = BuscarData('fim$suf$id'); var c = document.getElementById('rep$suf$id').value; InserirRep(a,b,'$horaini','$horaf',c,$idboleia);\">OK</button>"
    . "<button onclick=\"Aparecer('r$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function DadosBoleia($idboleia, $iniciais) {
    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $nPara = 3;
    $len = count($p) / $nPara;
    $pass = "";
    for ($i = 0; $i < $len; $i++) {
        $pointer = $i * $nPara + 2;
        $pass.="<tr><td><label>Passageiro " . (1 + $i) . ": " . $p[$pointer] . "</label></td></tr>";
    }
    echo "<table class=\"table-bordered\" align=\"center\">"
    . "<tr><th><label>Condutor: $iniciais</label></th></tr>"
    . "$pass"
    . "</table>";
}

function CriarBoleia($id, $hora, $dia) {

    echo "<div  id=\"$id\" class=\"criarboleia container\" hidden >
                <table>
                    <tr><td colspan=\"2\">Quer inserir boleia?</td></tr> 
                    <tr><td><button onclick=\"InserirBoleia('$hora','$dia');\">Sim</button></td>"
    . "<td><button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function ColocarBoleia($id, $nome, $cor, $partida, $destino, $nlugares, $idboleia, $idutilizador, $horaini, $horaf, $rep) {
    $condutor = false;
    if ($idutilizador == $_SESSION['idutilizador']) {
        $condutor = true;
    }
    $nPara = 3;
    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $len = count($p) / $nPara;
    $h = 150 + (50 * $len * $nPara);
    $pass = "";
    $colocar = true;
    for ($i = 0; $i < $len; $i++) {
        $pointer = $i * $nPara;
        $pass.="<tr><td><label>Passageiro " . (1 + $i) . ": " . utf8_encode($p[$pointer]) . "</label></td></tr>";
        if ($p[$pointer + 1] == $_SESSION['idutilizador']) {
            $colocar = false;
        }
    }
    if ($condutor) {
        echo "<div  id=\"$id\" style=\"background-color:$cor; height:$h" . "px;\" class=\"criarboleia container\" hidden >
                <table class = \"table-condensed table-bordered \" style=\"background-color:$cor\">
                    <tr><td>Condutor:" . utf8_encode($nome) . "</td></tr>"
        . "<tr><td>Partida: <input id=\"p$id\" type=\"text\"; width=\"20\"; value=\"$partida\";/></td></tr> "
        . "<tr><td>Destino: <input id=\"d$id\" type=\"text\"; width=\"20\"; value=\"$destino\";/></td></tr>"
        . "<tr><td>Lugares: <input id=\"nl$id\" type=\"text\"; width=\"20\"; value=\"$nlugares\";/></td></tr>"
        . "<tr><td>Hora início: " . FazerHoras("ini$id", $horaini) . "</td></tr>"
        . "<tr><td>Hora fim: " . FazerHoras("f$id", $horaf) . "</td></tr>"
        . "<tr><td>Vagas: " . ($nlugares - $len) . "</td></tr>
  $pass
        <tr><td><button onclick=\"AlterarBoleia('$id','$idboleia')\">Alterar</button>
        ";
        CriarRepeticao("$id", "rep", $horaini, $horaf, $idboleia);
        echo "</td></tr>
        <tr><td><button onclick=\"EliminarOpcao('$idboleia','$rep')\">Eliminar</button>";
    } else {
        echo "<div  id=\"$id\" style=\"background-color:$cor; height:$h" . "px;\" class=\"criarboleia container\" hidden >
                <table class = \"table-condensed table-bordered \" style=\"background-color:$cor\">
                    <tr><td>Condutor:" . utf8_encode($nome) . "</td></tr>"
        . "<tr><td>Partida: $partida</td></tr> "
        . "<tr><td>Destino: $destino</td></tr>"
        . "<tr><td>Lugares: $nlugares</td></tr>"
        . "<tr><td>Vagas: " . ($nlugares - $len) . "</td></tr>
  $pass";

        if ($colocar && (($nlugares - $len) > 0)) {
            echo "<tr><td><button onclick=Aparecer('pass$id')>Entrar</button>";
            CriarPassageiro("pass$id", $idboleia);
            echo " </td></tr>";
        } else if (!$colocar) {
            echo "<tr><td><button onclick=EliminarPassageiro($idboleia," . $_SESSION['idutilizador'] . ")>Sair</button></td></tr>";
        }
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
        $bboleias = "select b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.idutilizador,u.nome,u.iniciais,u.cor,b.idboleia,b.boleias_idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador "
                . "where b.data='$dia' "
                . "and '$horai'>=b.horainicio "
                . "and '$horaf'<=b.horafim "
                . "and $dsemana=b.diasemana "
                . "and b.ativo=1 "
                . "order by b.horainicio asc";
    } else {
        $bboleias = "select b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.idutilizador,u.nome,u.iniciais,u.cor,b.idboleia,b.boleias_idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador " . "where b.data='$dia' "
                . "and '$horai'<=b.horainicio "
                . "and '$horaf'>b.horainicio " .
                "and $dsemana=b.diasemana "
                . "and b.ativo=1 " .
                " order by b.horainicio"
                . " asc limit 1,18446744073709551615";
    }
    $result = ligacao($bboleias);
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.= $row['horainicio'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . "," . $row['cor'] . ","
                . $row['partida'] . "," . $row['destino'] . "," . $row['nlugares'] . "," . $row['idboleia'] . "," . $row['idutilizador'] . "," . $row['boleias_idboleia'] . ",";
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
    $query = "select u.nome,u.iniciais,u.idutilizador from utilizadores u inner join passageiros p on u.idutilizador=p.idutilizador where p.idboleia=$idboleia and ativo=1";
    $result = ligacao($query);
    if (!$result) {
        echo "<br/>Ocorreu um erro na query<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    $r = "";
    while ($row = mysql_fetch_assoc($result)) {
        $r.= $row['nome'] . "," . $row['idutilizador'] . "," . $row['iniciais'] . ",";
    }
    return $r;
}

function FazerHoras($id, $hora) {
    $str = "<select id=\"hora$id\">";
    $h = date("H", strtotime($hora));
    $m = date("i", strtotime($hora));
    for ($i = 7; $i <= 23; $i++) {
        $str.="<option ";
        if ($i == $h) {
            $str.="selected ";
        }
        $str.=">$i</option>";
    }
    $str.="</select><select id=\"min$id\">";
    for ($i = 0; $i <= 3; $i = $i + 3) {
        $str.="<option ";
        if ($i + "0" == substr($m, 0, -1)) {
            $str.="selected ";
        }
        $str.=">:$i" . "0</option>";
    }
    $str.="</select>";
    return $str;
}

function InserirBoleiaData($data,$id) {
    return "<button onclick=\"Aparecer('$id');\">+</button>"
    . "<div id=\"$id\" class=\"criarboleia container\" style=\" background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\">
              " . "<tr><td>Hora início: " . FazerHoras("ini$id", "07:00") . "</td></tr>"
                . "<tr><td>Hora fim: " . FazerHoras("f$id", "07:30") . "</td></tr>" .
                  "<tr><td><button onclick=\"InserirBoleiaData('$data','$id')\">OK</button>"
                . "<button onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}
