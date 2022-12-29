<?php
    session_start();
    require_once("../src/conn.php");
    use Exception as GlobalException;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './vendor/autoload.php';

    $email = !empty(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $assunto = !empty(filter_input(INPUT_POST, 'assunto')) ? filter_input(INPUT_POST, 'assunto') : '';
    $acessoLiberado = !empty(filter_input(INPUT_POST, 'acessoLiberado')) ? filter_input(INPUT_POST, 'acessoLiberado') : '';
    $bloqueado = !empty(filter_input(INPUT_POST, 'bloquear')) ? filter_input(INPUT_POST, 'bloquear') : '';
    $mensagem = !empty(filter_input(INPUT_POST, 'mensagem')) ? filter_input(INPUT_POST, 'mensagem') : '';

    if(!empty($email) && !empty($assunto) && !empty($acessoLiberado) && !empty($mensagem))
    {
        if($acessoLiberado == 1 && empty($bloqueado))
        {
            $conexao = new Conexao();
            $stmt = $conexao->conn();
            $resp = $stmt->prepare("SELECT * FROM usuarios WHERE email = '$email' LIMIT 1");
            if($resp->execute())
            {
                while($dadosUsuario = $resp->fetch(PDO::FETCH_ASSOC))
                {
                    $ativo = $dadosUsuario['active'];
                }

                if($ativo == 1)
                {
                    echo 201;
                    die;
                }
                else if($ativo == 0)
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
                        $mail->CharSet    = 'UTF-8';

                        //Recipients
                        $mail->setFrom('qualidade@suportespi.com.br', 'Code Access');
                        $mail->addAddress("$email", 'Anonimo');
                    
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "$assunto";
                        $mail->Body    = "
                        <div>
                            <p>{$mensagem}</p>
                        </div>";
                    
                        if($mail->send())
                        {
                            $respConn = new Conexao();
                            $stmt = $respConn->conn();
                            $stmt = $stmt->prepare("UPDATE usuarios SET active = 1, verify = 1 WHERE email=:email");
                            $stmt->bindParam(':email', $email);
                            if($stmt->execute())
                            {
                                echo 200;
                                die;
                            }
                        }
                    } catch (GlobalException $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
        else if($acessoLiberado == 2 && !empty($bloqueado))
        {
            $conexao = new Conexao();
            $stmt = $conexao->conn();
            $resp = $stmt->prepare("SELECT * FROM usuarios WHERE email='$email'");
            $resp->execute();

            if($bloqueado == 1)
            {
                $inativo = false;
                while($user = $resp->fetch(PDO::FETCH_ASSOC))
                {
                    if(!empty($user['active']) == 1)
                    {
                        $inativo = true;
                    }
                }

                if($inativo)
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
                        $mail->CharSet    = 'UTF-8';

                        //Recipients
                        $mail->setFrom('qualidade@suportespi.com.br', 'Code Access');
                        $mail->addAddress("$email", 'Anonimo');
                    
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "$assunto";
                        $mail->Body    = "
                        <div>
                            <p>{$mensagem}</p>
                        </div>";
                    
                        if($mail->send())
                        {
                            $respConn = new Conexao();
                            $stmt = $respConn->conn();
                            $stmt = $stmt->prepare("UPDATE usuarios SET active = 0, verify = 0 WHERE email=:email");
                            $stmt->bindParam(':email', $email);
                            if($stmt->execute())
                            {
                                echo 202;
                                die;
                            }
                        }
                    } catch (GlobalException $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                else if(!$inativo)
                {
                    echo 204;
                    die;
                }
            }
            else if($bloqueado == 2)
            {
                echo 222;
                die;
            }
            else
            {
                // OPÇÃO INVÁLIDA
                echo 404;
                die;
            }
        }
        else
        {
            echo 404;
            die;
        }
    }
    else 
    {
        echo 404;
        die;
    }
?>