<meta charset="UTF-8">
<?php

include "./functions.php";
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

$query = "select email,idutilizador,nome,iniciais,cor,contacto,voip,nlugares,partida,destino from utilizadores where email='$email' and password='$password';";
$result = ligacao($query);
echo "dfshj".$query.$result.$email.$password;
if (!$result) {
        echo "delimitador/<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
    }
if(mysql_num_rows($result) == 0){
    echo "delimitador/Login ou password errados.";
    exit;
}
    while ($row = mysql_fetch_assoc($result)) {
        $_SESSION["email"] = $row['email'];
        $_SESSION["idutilizador"] = $row['idutilizador'];
        $_SESSION["nome"] = utf8_encode($row['nome']);
        $_SESSION["iniciais"] = $row['iniciais'];
        $_SESSION["cor"] = $row['cor'];
        $_SESSION["contacto"] = $row['contacto'];
        $_SESSION["voip"] = $row['voip'];
        $_SESSION["nlugares"] = $row['nlugares'];
        $_SESSION["partida"] = $row['partida'];
        $_SESSION["destino"] = $row['destino'];
    }
