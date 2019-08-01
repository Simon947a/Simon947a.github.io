<?php


if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!";
   return false;
   }
   
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
  

require 'PHPMailer/PHPMailerAutoload.php';


$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.arrsa.pl';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'fl24form@arrsa.pl';                 // SMTP username
$mail->Password = 'form$Fl17';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->CharSet = 'UTF-8';
$mail->setFrom('fl24form@arrsa.pl', 'FL24 WebMailer');
$mail->addAddress('fablab24@arrsa.pl');        
$mail->addReplyTo($email_address, $name);

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Zapytanie ze strony FL24.PL od '.$name;
$mail->Body    = 'Wiadomość wygenerowana dnia '.date('d.m.Y').'r. o godz. '.date('H:i:s').' poprzez formularz kontaktowy.<br/><br/><strong>Imię:</strong> '.$name.'<br/><br/><strong>Adres e-mail:</strong> '.$email_address.'<br/><br/><strong>Telefon:</strong> '.$phone.'<br/><br/><strong>Wiadomość:</strong><br/>'.$message.'<br/><br/>';
// $mail->AltBody = '';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}


?>

