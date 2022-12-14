<?php
    session_start();
    require_once("../../../conn_gerenciador_acesso/conn.php");

    $email = !empty(filter_input(INPUT_POST, 'mail')) ? filter_input(INPUT_POST, 'mail') : '';
    $respConn = new Conexao();
    $stmt = $respConn->conn();
    $stmt = $stmt->prepare("UPDATE usuarios SET active = 1, verify = 1 WHERE email=:email");
    $stmt->bindParam(':email', $email);
    if($stmt->execute())
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
?>