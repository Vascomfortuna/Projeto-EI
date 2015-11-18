<?php

require_once "Mail.php";

// Dados de autenticação SMTP
/*$smtpinfo['host'] = 'ssl://smtp.gmail.com';
$smtpinfo['port'] = '465';
$smtpinfo['auth'] = true;
$smtpinfo['username'] = 'projetocarpooling@gmail.com'; /* Altere este campo para o email do seu domínio 
$smtpinfo['password'] = '621d2d621d2d'; /* Altere este campo para a password do email */
$smtpinfo = array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'projetocarpooling@gmail.com',
            'password' => '621d2d621d2d'
        );


// Inclusão de ficheiro PEAR. Certifique-se que o PEAR está activado no seu alojamento


// Corpo da mensagem
$body = "qlqr coisa";
$headers = array ('From' => "projetocarpooling@gmail.com",
'To' => "vascomfortuna@gmail.com",
'Subject' => 'Teste ao SMTP');
$mail_object = Mail::factory('smtp', $smtpinfo);
$mail = $mail_object->send("vascomfortuna@gmail.com", $headers, $body);
echo "debug:$mail";
if ( PEAR::isError($mail) ) {
echo $mail->getMessage();
} else {
echo '<b>Mensagem enviada!</b>';
}



