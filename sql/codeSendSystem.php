<?php session_start()?>
<?php
require_once("../src/conn.php");

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$email = $_SESSION['email'];

$stmt = new Conexao();
$resp = $stmt->conn();
$resp = $resp->prepare("SELECT * FROM tb_emails_gerenciais WHERE MAIL =:email");
$resp->bindParam(':email', $email);

if($resp->execute())
{
    $code = $resp->fetch(PDO::FETCH_ASSOC)['CODE'];

    if(empty($code))
    {
        print_r(0);
    }
    else if(!empty($code))
    {
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.suportespi.com.br';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'qualidade@suportespi.com.br';                     //SMTP username
            $mail->Password   = '2v=a5OKSTAVe';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('qualidade@suportespi.com.br', 'Code Access');
            $mail->addAddress("$email", 'Anonimo');
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Codigo Liberacao';
            $mail->Body    = "
            <div style='text-align: center;'>
                <p>{$code}</p>
            </div>";
        
            if($mail->send())
            {
                print_r(1);
            }
        } catch (GlobalException $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
else
{
    print_r(0);
}