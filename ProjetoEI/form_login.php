<meta charset="UTF-8">
<?php

include "./functions.php";
$email = filter_input(INPUT_POST, "email");
$password = filter_input(INPUT_POST, "password");

$query = "select idutilizador,nome from utilizadores where email='$email' and password='$password'";
$result = ligacao($query);
echo "dfshj".$result;
if (!$result) {
        echo "delimitador/<br/>Ocorreu um erro na query<br/>";
            echo 'MySQL Error: ' . mysql_error();
    }
if(mysql_num_rows($result) == 0){
    echo "delimitador/Login ou password errados.";
    exit;
}
    while ($row = mysql_fetch_assoc($result)) {
        $_SESSION["idutilizador"] = $row['idutilizador'];
        $_SESSION["nome"] = utf8_encode ($row['nome']);
    }
