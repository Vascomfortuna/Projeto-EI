<?php

error_reporting(0);
session_start();
?>
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
                    location.reload();
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
    function AlterarUtilizadorAdmin(idutilizador)
    {
        var xmlhttp;
        nome = document.getElementById("nome").value;
        str = "partida=" + document.getElementById("partida").value + "&destino=" + document.getElementById("destino").value
                + "&voip=" + document.getElementById("voip").value + "&nome=" + nome + "&nlugares="
                + document.getElementById("nlugares").value + "&contacto=" + document.getElementById("contacto").value
                + "&cor=" + document.getElementById("cor").value
                + "&iniciais=" + document.getElementById("iniciais").value
                + "&email=" + document.getElementById("email").value
                + "&idutilizador=" + idutilizador;

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
                var x = xmlhttp.responseText.split("delimitador7/");
                if (typeof x[2] !== 'undefined') {
                    document.getElementById("adminmsg").innerHTML = x[2];
                } else {
                    InserirAlteracao("O administrador alterou o utilizador " + nome + ".", "", 0);
                    document.getElementById("adminmsg").innerHTML = "Alteração efectuada.";
                }
            }
        };
        xmlhttp.open("POST", "form_alterarutilizadoradmin.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }

    function MapaBoleia(data, filtro)
    {
        if (typeof data != "undefined") {
            document.cookie = "d=" + data;
        }
        if (typeof filtro != "undefined") {
            document.cookie = "f=" + filtro;
        }
        if(filtro=="1"){
            document.getElementById("filtro").innerHTML="Filtro: Minhas boleias.";
        }else{
            document.getElementById("filtro").innerHTML="Filtro: Nenhum.";
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
                InserirAlteracao("O utilizador inseriu uma boleia na data " + dia + " com a hora inicial " + hora + ".", "", 1);
            }
        };
        xmlhttp.open("POST", "form_inserirboleia.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function AlterarBoleia(id, idboleia, data)
    {
        var xmlhttp;
        horaini = "" + document.getElementById("horaini" + id).value + document.getElementById("minini" + id).value;
        horaf = "" + document.getElementById("horaf" + id).value + document.getElementById("minf" + id).value;
        str = "idboleia=" + idboleia + "&partida=" + document.getElementById("p" + id).value + "&destino=" + document.getElementById("d" + id).value
                + "&horaini=" + horaini + "&horaf=" + horaf + "&nlugares=" + document.getElementById("nl" + id).value + "&data=" + data;
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
                msg2 = xmlhttp.responseText.split("delimitador110/");
                alert(msg2[2]);
                InserirAlteracao("A boleia com o id " + idboleia + " com a data " + data + " com a hora inicial " + horaini + " e a hora final " + horaf + " foi alterada.", "", 1);
            }
        };
        xmlhttp.open("POST", "form_alterarboleia.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function EliminarOpcao(idboleia, rep, horaini, horaf, data) {
        if (rep == '') {
            EliminarBoleia(idboleia, horaini, horaf, data);
        } else if (confirm("Esta boleia faz parte de uma repetição. Quer eliminar todas as boleias associadas?")) {
            EliminarRepeticao(idboleia, rep);
        } else {
            EliminarBoleia(idboleia, horaini, horaf, data);
        }
    }
    function EliminarBoleia(idboleia, horaini, horaf, data)
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
                    InserirAlteracao("Foi eliminada a boleia com o id " + idboleia + " com a data " + data + " com a hora inicial " + horaini + " e a hora final " + horaf + ".", "", 1);
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
    function InserirPassageiro(idboleia, nota, vu, horaini, horaf, data)
    {
        str = "idboleia=" + idboleia + "&vu=" + vu;
        if (nota != "") {
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
                desc = "O utilizador entrou como passageiro na boleia " + idboleia + " com a data " + data + " com a hora inicial " + horaini + " e a hora final " + horaf + ".";
                if (vu == 0) {
                    desc += " A viagem é de ida e volta.";
                } else if (vu == 1) {
                    desc += " A viagem é só de ida.";
                } else if (vu == 2) {
                    desc += " A viagem é só de volta.";
                }
                InserirAlteracao(desc, "", 1);
            }
        };
        xmlhttp.open("POST", "form_inserirpassageiro.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function InserirRep(dataini, dataf, horaini, horaf, rep, idboleia,distrib)
    {

        str = "dataini=" + dataini + "&dataf=" + dataf + "&horaini=" + horaini + "&horaf=" + horaf + "&rep=" + rep + "&idboleia=" + idboleia;
        if(distrib){
            str+="&distrib=true";
        }else{
            str+="&distrib=false";
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
                InserirAlteracao("O utilizador inseriu uma repetição a partir de " + dataini + " até " + dataf + " com a hora inicial " + horaini + " e com a hora final " + horaf + " para a boleia " + idboleia + ".", "", 1);
            }
        };
        xmlhttp.open("POST", "form_inserirrepeticao.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }


    function EliminarPassageiro(idboleia, idutilizador, horaini, horaf, data)
    {
        if (confirm("Quer sair desta boleia?")) {
            str = "idboleia=" + idboleia + "&idutilizador=" + idutilizador;

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
                    InserirAlteracao("O utilizador saiu da boleia " + idboleia + " com a data " + data + " com a hora inicial " + horaini + " e com a hora final " + horaf + ".", "", 1);
                }
            };
            xmlhttp.open("POST", "form_eliminarpassageiro.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("" + str);
        }
    }
    function InserirBoleiaData(data, id) {
        var xmlhttp;
        horaini = "" + document.getElementById("horaini" + id).value + document.getElementById("minini" + id).value;
        horaf = "" + document.getElementById("horaf" + id).value + document.getElementById("minf" + id).value;
        str = "horaini=" + horaini + "&horaf=" + horaf + "&data=" + data;
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
                InserirAlteracao("O utilizador criou uma boleia com a data " + data + " com a hora inicial " + horaini + " e com a hora final " + horaf + ".", "", 1);
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
        return dat;

    }


    function MudarForm(form) {
        str = "form=" + form;
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
                document.getElementById("adminform").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST", "form_mudaradmin.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }

    function AdicionarUtilizador() {
        nome = "" + document.getElementById("nome").value;
        pass = "" + document.getElementById("password").value;
        pass2 = "" + document.getElementById("password2").value;
        email = "" + document.getElementById("email").value;
        contacto = "" + document.getElementById("contacto").value;
        iniciais = "" + document.getElementById("iniciais").value;
        cor = "" + document.getElementById("cor").value;
        voip = "" + document.getElementById("voip").value;
        nlugares = "" + document.getElementById("nlugares").value;
        partida = "" + document.getElementById("partida").value;
        destino = "" + document.getElementById("destino").value;
        if (pass !== pass2) {
            document.getElementById("adminmsg").innerHTML = "Passwords não coincidem.";
        } else {
            str = "nome=" + nome + "&password=" + pass + "&email=" + email + "&contacto=" + contacto + "&iniciais=" + iniciais
                    + "&cor=" + cor + "&voip=" + voip + "&nlugares=" + nlugares + "&partida=" + partida + "&destino=" + destino;
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
                    var msg = xmlhttp.responseText.split("delimitador6/");
                    if (typeof msg[2] !== 'undefined') {
                        document.getElementById("adminmsg").innerHTML = "Ocorreu um erro.";
                    } else {
                        document.getElementById("adminmsg").innerHTML = "Utilizador adicionado.";
                        InserirAlteracao("Foi inserido o utilizador com o nome " + nome + "e com o email " + email + ".", "", 0);
                    }
                }
            };
            xmlhttp.open("POST", "form_adicionarutilizador.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("" + str);
        }

    }
    function PreencherAltUtilizador(idutilizador) {
        str = "idutilizador=" + idutilizador;
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
                document.getElementById("utilizadoralt").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("POST", "form_preencheraltutilizador.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function EliminarUtilizador(idutilizador, nome)
    {
        if (idutilizador == "1") {
            alert("Não podes eliminar o administrador!");
        } else
        if (confirm("Quer eliminar este utilizador? Todas as informações ligadas a este utilizador serão eliminadas!")) {
            str = "idutilizador=" + idutilizador;

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
                    var msg = xmlhttp.responseText.split("delimitador8/");
                    if (typeof msg[2] !== 'undefined') {
                        document.getElementById("adminmsg").innerHTML = msg[2];
                    } else {
                        document.getElementById("adminmsg").innerHTML = "Utilizador eliminado.";
                        InserirAlteracao("Foi eliminado o utilizador com o id " + idutilizador + " e com o nome " + nome + ".", "", 1);

                    }
                }
            };
            xmlhttp.open("POST", "form_eliminarutilizador.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("" + str);
        }
    }
    function InserirAlteracao(descricao, nota, reload) {
        var xmlhttp;
        str = "descricao=" + descricao + "&nota=" + nota;
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
                if (reload == 1) {
                    if (document.getElementById("divmapa") == null) {
                        location.reload();
                    } else {
                        MapaBoleia();
                    }
                }
            }
        };
        xmlhttp.open("POST", "form_inseriralteracao.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
    }
    function ColocarEstatisticaUtilizadorMes(idutilizador, mes, ano, id) {
        var xmlhttp;
        str = "idutilizador=" + idutilizador + "&mes=" + mes + "&ano=" + ano;
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
                x = xmlhttp.responseText.split("delimitador10/");
                document.getElementById(id).innerHTML = x[2];
            }
        };
        xmlhttp.open("POST", "form_estatisticautilizadormes.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("" + str);
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
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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

function CriarPassageiro($id, $idboleia, $horaini, $horaf, $data) {
    echo "<div  id=\"$id\" class=\"criarboleia container\" style=\"height:150px; width:340px; background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\" style=\"color:" . Contraste($_SESSION["cor"]) . ";\" >
                    <tr><td>Viagem:</td>
                    <td><select style=\"color:black\" id=\"vu$id\">
                    <option selected value=\"0\">Ida e volta</option>
                    <option value=\"1\">Só ida</option>
                    <option value=\"2\">Só volta</option>
                </select></td></tr> 
                <tr><td>Nota(max:255):</td><td><textarea style=\"color:black\" rows=\"2\" cols=\"20\" maxlength=\"255\" id=\"nota$id\"></textarea > </td></tr> 
                    <tr><td><button style=\"color:black;\" onclick=\"InserirPassageiro('$idboleia',document.getElementById('nota$id').value,document.getElementById('vu$id').value,'$horaini','$horaf','$data');\">OK</button></td>"
    . "<td><button style=\"color:black;\" onclick=\"Aparecer('$id')\">Fechar</button></td></tr>
                </table>
              </div>";
}

function CriarRepeticao($id, $suf, $horaini, $horaf, $idboleia, $distri) {
    //Função para colocar o conteúdo do formulário de repetir boleia
    $r = "<tr><td><button style=\"color:black;\" onclick=\"ColocarData('ini$suf$id');ColocarData('fim$suf$id');Aparecer('r$id');\">Repetir</button>"
            . "<div id=\"r$id\" class=\"criarboleia container\" style=\"height:150px; width:340px; background-color:" . $_SESSION["cor"] . ";\" hidden >
                <table class=\"table-bordered\">
                    <tr><td>Data de início:</td><td id=\"ini$suf$id\"></td></tr>
                    <tr><td>Data de fim:</td><td id=\"fim$suf$id\"></td></tr>
                    <tr><td>Período</td><td><select id=\"rep$suf$id\"><option value=\"0\">Diariamente</option><option value=\"1\">Semanalmente</option></select></td></tr>";
    if ($distri) {
        $r.="<tr><td colspan=\"2\">Distribuir passageiros:<input style=\"height:100%\" id=\"dis$suf$id\" type=\"checkbox\"/></td></tr>";
    }
    $r.="<tr><td><button onclick=\"var a = BuscarData('ini$suf$id'); var b = BuscarData('fim$suf$id'); var c = document.getElementById('rep$suf$id').value; var db = document.getElementById('dis$suf$id').checked;  InserirRep(a,b,'$horaini','$horaf',c,$idboleia,db);\">OK</button>"
            . "<button onclick=\"Aparecer('r$id')\">Fechar</button></td></tr>
                </table>
              </div>";
    echo $r;
}

function DadosBoleia($idboleia, $iniciais, $cor, $cons) {

    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $nPara = 5;
    $len = count($p) / $nPara;
    $pass = "";
    if ($cons == 0) {
        for ($i = 0; $i < $len; $i++) {
            $pointer = $i * $nPara;
            $pass.="/" . $p[$pointer + 2];
            /*if ($p[$pointer + 3] == 0) {
                $pass.="(IeV)";
            } else if ($p[$pointer + 3] == 1) {
                $pass.="(I)";
            } else {
                $pass.="(V)";
            }*/
            if ($p[$pointer + 4] != "") {
                $pass.="(*)";
            }
            
        }
        echo "<table class=\"table-condensed\" style=\"background-color:$cor; width:100%; color:" . Contraste($cor) . ";\" align=\"center\">"
        . "<tr><th><label>$iniciais$pass</label></th></tr>"
        . "</table>";
    } else {
        for ($i = 0; $i < $len; $i++) {
            $pointer = $i * $nPara;
            $pass.= $p[$pointer + 2];

            if ($i != $len - 1) {
                $pass.="/";
            }
        }
        echo "<table class=\"table-condensed\" style=\"background-color:$cor; width:100%; color:" . Contraste($cor) . ";\" align=\"center\">"
        . "<tr><th>C:$iniciais</br>"
        . "P:$pass"
        . "</th></tr></table>";
    }
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

function ColocarBoleia($id, $nome, $cor, $partida, $destino, $nlugares, $idboleia, $idutilizador, $horaini, $horaf, $rep, $data) {
    //Função para colocar o conteúdo da div quando se clica numa boleia
    $condutor = false;
    $distri = false;
    $idu = $_SESSION['idutilizador'];
    if ($idutilizador == $idu || $idu == "1") {
        $condutor = true;
    }
    $nPara = 5;
    $p = explode(',', BuscarPassageiros($idboleia), -1);
    $len = count($p) / $nPara;
    $h = 300 + (50 * $len);
    $pass = "";
    $colocar = true;
    if (!empty($p)) {
        $distri = true;
    }
    for ($i = 0; $i < $len; $i++) {
        $pointer = $i * $nPara;
        $pass.="<tr><td><label>Passageiro " . (1 + $i) . ": " . $p[$pointer] . "</label></br>";
        if ($p[$pointer + 3] == 0) {
            $pass.="<label>Ida e volta.</label></br>";
        } else if ($p[$pointer + 3] == 1) {
            $pass.="<label>Só ida.</label></br>";
        } else {
            $pass.="<label>Só volta.</label></br>";
        }
        if ($p[$pointer + 4] != "") {
            $pass.="<label>Nota:" . $p[$pointer + 4] . "</label>";
        }
        $pass.="</td></tr>";
        if ($p[$pointer + 1] == $_SESSION['idutilizador']) {
            $colocar = false;
        }
    }
    if ($condutor) {
        echo "<div  id=\"$id\" style=\"background-color:$cor; height:" . ($h + 150) . "px;\" class=\"criarboleia container\" hidden>
                <table class = \"table-condensed table-bordered \" style=\"background-color:$cor; color:" . Contraste($cor) . "\">
                    <tr><td>Condutor:" . $nome . "</td></tr>"
        . "<tr><td>Partida: <input style=\"color:black;\" id=\"p$id\" type=\"text\"; width=\"20\"; value=\"$partida\";/></td></tr> "
        . "<tr><td>Destino: <input style=\"color:black;\" id=\"d$id\" type=\"text\"; width=\"20\"; value=\"$destino\";/></td></tr>"
        . "<tr><td>Lugares: <input style=\"color:black;\" id=\"nl$id\" type=\"text\"; width=\"20\"; value=\"$nlugares\";/></td></tr>"
        . "<tr><td>Hora início: " . FazerHoras("ini$id", $horaini) . "</td></tr>"
        . "<tr><td>Hora fim: " . FazerHoras("f$id", $horaf) . "</td></tr>"
        . "<tr><td>Vagas: " . ($nlugares - $len) . "</td></tr>
        $pass
        <tr><td><button style=\"color:black;\" onclick=\"AlterarBoleia('$id','$idboleia','$data');\">Alterar</button>
        ";
        CriarRepeticao("$id", "rep", $horaini, $horaf, $idboleia, $distri);
        echo "</td></tr>
        <tr><td><button style=\"color:black;\" onclick=\"EliminarOpcao('$idboleia','$rep','$horaini','$horaf','$data')\">Eliminar</button>";
        if($idu == "1"){
            if ($colocar && (($nlugares - $len) > 0)) {
            echo "<tr><td><button style=\"color:black;\" onclick=Aparecer('pass$id')>Entrar</button>";
            CriarPassageiro("pass$id", $idboleia, $horaini, $horaf, $data);
            echo " </td></tr>";
        } else if (!$colocar) {
            echo "<tr><td><button style=\"color:black;\" onclick=EliminarPassageiro($idboleia," . $_SESSION['idutilizador'] . ",'$horaini','$horaf','$data')>Sair</button></td></tr>";
        }
        }
    } else {
        echo "<div  id=\"$id\" style=\"background-color:$cor; height:$h" . "px;\" class=\"criarboleia container\" hidden >
                <table class = \"table-condensed table-bordered \" style=\"background-color:$cor; color:" . Contraste($cor) . "\">
                    <tr><td>Condutor:" . $nome . "</td></tr>"
        . "<tr><td>Partida: $partida</td></tr> "
        . "<tr><td>Destino: $destino</td></tr>"
        . "<tr><td>Lugares: $nlugares</td></tr>"
        . "<tr><td>Vagas: " . ($nlugares - $len) . "</td></tr>
  $pass";

        if ($colocar && (($nlugares - $len) > 0)) {
            echo "<tr><td><button style=\"color:black;\" onclick=Aparecer('pass$id')>Entrar</button>";
            CriarPassageiro("pass$id", $idboleia, $horaini, $horaf, $data);
            echo " </td></tr>";
        } else if (!$colocar) {
            echo "<tr><td><button style=\"color:black;\" onclick=EliminarPassageiro($idboleia," . $_SESSION['idutilizador'] . ",'$horaini','$horaf','$data')>Sair</button></td></tr>";
        }
    }
    echo "<tr><td><button onclick=Aparecer('$id') style=\"color:black;\">Fechar</button></td></tr> </table> </div>";
}

function ligacao($query) {
    /* $ligacao = mysql_connect("localhost", "root", "");
      if (!$ligacao) {
      die("nao foi possivel ligar:" . mysql_error());
      }
      mysql_select_db("mydb");
      $result = mysql_query($query, $ligacao);
      return $result; */
    try {
        $connection_string = sprintf('mysql:host=%s;dbname=%s;charset=UTF8', "localhost", "mydb");
        $ligacao = new PDO($connection_string, "root", "");
        $ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $ligacao->prepare($query);
        $stmt->execute();
        return $stmt;
    } catch (PDOException $ex) {
        $error = $ex->getMessage();
        die("erro:" . $error);
    }
}

function BuscarMembros() {
    $bmembros = "select nome,cor,idutilizador from utilizadores";
    try {
        $result = ligacao($bmembros);
        if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        $r = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $r.=$row['cor'] . "," . $row['nome'] . "," . $row['idutilizador'] . ",";
        }
        return $r;
    } catch (PDOException $e) {
        die($e);
    }
}

function BuscarUtilizador($idutilizador) {
    $bmembros = "select email,nome,cor,contacto,voip,iniciais,nlugares,partida,destino,ncondutor,npassageiro,npessoaslevadas from utilizadores where idutilizador=$idutilizador";
    try {
        $result = ligacao($bmembros);
        if (!$result) {
            echo "<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        $r = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $r.=$row['email'] . "," . $row['nome'] . "," . $row['cor'] . "," . $row['contacto'] . "," . $row['voip'] . "," . $row['iniciais'] . "," . $row['nlugares'] . "," . $row['partida'] . "," . $row['destino'] . "," . $row['ncondutor'] . "," . $row['npassageiro'] . "," . $row['npessoaslevadas'] . ",";
        }
        return $r;
    } catch (PDOException $e) {
        die($e);
    }
}

function BuscarBoleias($dia, $horai, $horaf, $dsemana, $sobre, $filtro) {
    if ($sobre == 0) {
        $bboleias = "select b.data,b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.idutilizador,u.nome,u.iniciais,u.cor,b.idboleia,b.boleias_idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador ";
        if ($filtro == "1") {
            $bboleias.="left join passageiros p on b.idboleia=p.idboleia ";
        }
        $bboleias.= "where b.data='$dia' "
                . "and '$horai'>=b.horainicio "
                . "and '$horaf'<=b.horafim "
                . "and $dsemana=b.diasemana "
                . "and b.ativo=1 ";
        if ($filtro == "1") {
            $bboleias.= " and (b.idutilizador=" . $_SESSION['idutilizador'] . " or (p.idutilizador=" . $_SESSION['idutilizador'] . " and p.ativo=1))";
        }
        $bboleias.= " order by b.horainicio asc,b.idboleia asc";
    } else {
        $bboleias = "select b.data,b.horainicio,b.horafim,b.nlugares,b.partida,b.destino,u.idutilizador,u.nome,u.iniciais,u.cor,b.idboleia,b.boleias_idboleia from boleias b "
                . "inner join utilizadores u on b.idutilizador=u.idutilizador ";
        if ($filtro == "1") {
            $bboleias.="left join passageiros p on b.idboleia=p.idboleia ";
        }
        $bboleias.= "where b.data='$dia' "
                . "and '$horai'<=b.horainicio "
                . "and '$horaf'>b.horainicio " .
                "and $dsemana=b.diasemana "
                . "and b.ativo=1 ";
        if ($filtro == "1") {
            $bboleias.= " and (b.idutilizador=" . $_SESSION['idutilizador'] . " or (p.idutilizador=" . $_SESSION['idutilizador'] . " and p.ativo=1))";
        }
        $bboleias.=" order by b.horainicio asc,b.idboleia asc limit 1,18446744073709551615";
    }
    $result = ligacao($bboleias);
    $r = "";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $r.= $row['horainicio'] . "," . $row['horafim'] . "," . $row['iniciais'] . "," . $row['nome'] . "," . $row['cor'] . ","
                . $row['partida'] . "," . $row['destino'] . "," . $row['nlugares'] . "," . $row['idboleia'] . "," . $row['idutilizador'] . "," . $row['boleias_idboleia'] . "," . $row['data'] . ",";
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
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
    $query = "select u.nome,u.iniciais,u.idutilizador,p.viagemunica,p.nota from utilizadores u inner join passageiros p on u.idutilizador=p.idutilizador where p.idboleia=$idboleia and ativo=1";
    $result = ligacao($query);
    if (!$result) {
        echo "<br/>Ocorreu um erro na query<br/>";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    $r = "";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $r.= $row['nome'] . "," . $row['idutilizador'] . "," . $row['iniciais'] . "," . $row['viagemunica'] . "," . $row['nota'] . ",";
    }
    return $r;
}

function FazerHoras($id, $hora) {
    $str = "<select style=\"color:black;\" id=\"hora$id\">";
    $h = date("H", strtotime($hora));
    $m = date("i", strtotime($hora));
    for ($i = 7; $i <= 23; $i++) {
        $str.="<option ";
        if ($i == $h) {
            $str.="selected ";
        }
        $str.=">$i</option>";
    }
    $str.="</select><select style=\"color:black;\" id=\"min$id\">";
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

function InserirBoleiaData($data, $id) {
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

function CriarContacto($idutilizador, $id) {
    $u = explode(',', BuscarUtilizador($idutilizador), -1);
    echo "<div  id=\"$id\" class=\"criarboleia container\" hidden style=\"background-color:$u[2];\">
                <table style=\"color:" . Contraste($u[2]) . ";\">
                    <tr><td>Email:$u[0]</td></tr> 
                    <tr><td>Nome:" . $u[1] . "</td></tr>
                    <tr><td>Contacto:$u[3]</td></tr>
                    <tr><td>VOIP:$u[4]</td></tr>   
                    <tr><td>Iniciais:$u[5]</td></tr> 
                    <tr><td>Nº de vezes que foi condutor:$u[9]</td></tr>
                    <tr><td>Nº de vezes que foi passageiro:$u[10]</td></tr>
                    <tr><td>Nº de pessoas que levou:$u[11]</td></tr>    
                    <tr><td><button onclick=\"Aparecer('$id')\" style=\"color:black\">Fechar</button></td></tr>  
                </table>
              </div>";
}

function Contraste($cor) {
    return (hexdec($cor) > 0xffffff / 2) ? 'black' : 'white';
}
