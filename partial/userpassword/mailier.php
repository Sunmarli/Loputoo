<?php


global $password;

require __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


//require_once dirname(__DIR__) . '/vendor/autoload.php';

// Disable openssl extension check
define('PHPMAILER_QUIET', true);


$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Username = 'fortestingp93@gmail.com';
$mail->Password = $password='mddx jkjy mkng xmuo';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->isHTML(true);

return $mail;




?>
