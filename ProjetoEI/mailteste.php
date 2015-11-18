 <?php
 function sendSimpleEmail($to, $from_name, $from_email, $subject, $message, $format) {
                $headers = 'From:=?utf-8?B?'.base64_encode($from_name).'?= <'.$from_email.'>'."\r\n";
                $headers .= 'Return-Path: ' . $from_email . "\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: '.$format.'; charset=utf-8' . "\r\n";
                $headers .= 'Content-Transfer-Encoding: 8bit'. "\n\r\n";
                $subject = "=?utf-8?B?" . base64_encode($subject) . "?=";
                mail($to, $subject, $message, $headers);
                return true;
 }
 $from = "projetocarpooling@gmail.com";
 $from_name = "Car pooling";
 $general_email = 'vascomfortuna@gmail.com'; // DEBUGGER
 $to= $general_email;
 $subject= "qlqr coisa"; // $subject_tpl
$format= "text/html";
sendSimpleEmail($to, $from_name, $from_email, $subject, $message, $format);
echo "email";
