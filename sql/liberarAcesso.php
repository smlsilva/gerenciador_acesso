<?php
    session_start();
    require_once("../src/conn.php");

    $email = !empty(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $assunto = !empty(filter_input(INPUT_POST, 'assunto')) ? filter_input(INPUT_POST, 'assunto') : '';
    $acessoLiberado = !empty(filter_input(INPUT_POST, 'acessoLiberado')) ? filter_input(INPUT_POST, 'acessoLiberado') : '';
    $mensagem = !empty(filter_input(INPUT_POST, 'mensagem')) ? filter_input(INPUT_POST, 'mensagem') : '';

    if(!empty($email) && !empty($assunto) && !empty($acessoLiberado) && !empty($mensagem))
    {
        if($acessoLiberado == 1)
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
                }
                else if($ativo == 0)
                {
                    $respConn = new Conexao();
                    $stmt = $respConn->conn();
                    $stmt = $stmt->prepare("UPDATE usuarios SET active = 1, verify = 1 WHERE email=:email");
                    $stmt->bindParam(':email', $email);
                    if($stmt->execute())
                    {
                        echo 200;
                    }
                }
            }
        }
        else if($acessoLiberado == 2)
        {
            
        }
    }

?>