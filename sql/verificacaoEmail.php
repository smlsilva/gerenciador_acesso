<?php
    session_start();
    require_once("../src/conn.php");

    $email = !empty(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $respConn = new Conexao();
    $stmt = $respConn->conn();
    $stmt = $stmt->prepare("SELECT * FROM tb_emails_gerenciais WHERE MAIL =:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $emailExiste = false;

    while($emails = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        if(!empty($emails['MAIL']))
        {
            $emailExiste = true;
        }
    }

    if($emailExiste)
    {
        $code = rand(1000, 5000);

        $conn = new Conexao();
        $stmt = $conn->conn();
        $resp = $stmt->prepare("UPDATE tb_emails_gerenciais
        SET CODE = $code 
        WHERE MAIL =:email");
        $resp->bindParam(':email', $email);
        
        if($resp->execute())
        {
            $_SESSION['verify'] = 1;
            $_SESSION['email'] = $email;

            print_r(1);
        }
    }
    else
    {
        unset($_SESSION['verify']);
        print_r(0);
    }
?>