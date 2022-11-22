<?php
    session_start();
    require_once("../src/conn.php");

    $email = !empty(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $respConn = new Conexao();
    $stmt = $respConn->conn();
    $stmt = $stmt->prepare("SELECT * FROM usuarios WHERE email =:email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $emailExiste = false;

    while($emails = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        if(!empty($emails['email']))
        {
            $emailExiste = true;
        }
    }

    if($emailExiste)
    {
        print_r(1);
    }
    else
    {
        print_r(0);
    }
?>