<?php

require_once "Mail.php";
include "./functions.php";
$idboleia = filter_input(INPUT_POST, "idboleia");
$partida = filter_input(INPUT_POST, "partida");
$destino = filter_input(INPUT_POST, "destino");
$data = date("d-m-Y", strtotime(filter_input(INPUT_POST, "data")));
$horaini = date("H:i:s", strtotime(filter_input(INPUT_POST, "horaini")));
$horaf = date("H:i:s", strtotime(filter_input(INPUT_POST, "horaf")));
$nlugares = filter_input(INPUT_POST, "nlugares");
$em = filter_input(INPUT_POST, "em");

$r = "";
if (empty($nlugares)) {
    $nlugares = 4;
}
$query = "UPDATE boleias SET partida='$partida', destino='$destino', horainicio='$horaini', horafim='$horaf', nlugares=$nlugares where idboleia = $idboleia";
$result = ligacao($query);

if (!$result) {
    echo "<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    echo "sucess;";
}
if($em=="true"){
$query2 = "Select u.email from utilizadores u join passageiros p on u.idutilizador=p.idutilizador where p.idboleia=$idboleia";
$result2 = ligacao($query2);
echo "delimitador110/";
if (!$result2) {
    echo "<br/>Ocorreu um erro na query<br/>";
    echo 'MySQL Error: ' . mysql_error();
    exit;
} else {
    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        $r.= $row2['email'] . ",";
    }
    $u = explode(",", $r,-1);
    $subject="Alteração de boleia do dia $data";
    $body = "A sua boleia do dia $data foi alterada. A sua hora de partida é $horaini e a sua hora de chegada é $horaf.";
    if($partida!=""){
        $body+="A sua partida é $partida.";
    }
    if($destino!=""){
        $body+="O seu destino é $destino.";
    }
    for ($i = 0; $i < sizeof($u); $i++) {
        enviarEmail($u[$i],$subject, $body);
    }
    /*
$smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'projetocarpooling@gmail.com',
            'password' => '621d2d621d2d'
        ));
    while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
        $r.= $row2['email'] . ",";
    }
    $u = explode(",", $r,-1);
    echo "email:".$u[0];
    for ($i = 0; $i < sizeof($u); $i++) {
        $headers = array(
    'From' => "projetocarpooling@gmail.com",
    'To' => "".$u[$i],
    'Subject' => "Boleia alterada: $data."
);
       // $headers['To']-> $u[$i] + "";
        $mail = $smtp->send($u[$i] . "", $headers, "A sua boleia do dia $data com a partida $partida e o destino $destino foi alterada para a hora inicial $horaini e para a hora final $horaf.");
        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }
    }*/
echo "email";   
}
}        



