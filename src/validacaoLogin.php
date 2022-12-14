<?php
    session_start();
    require_once('../../../conn_gerenciador_acesso/conn.php');

    $tokenSession = session_id();
    $emailSession = !empty(filter_input(INPUT_POST, 'email')) ? filter_input(INPUT_POST, 'email') : '';
    $pass = !empty(filter_input(INPUT_POST, 'pass')) ? filter_input(INPUT_POST, 'pass') : '';
    $logado = false;

    if($tokenSession == session_id() && !empty($emailSession))
    {     
        $con = new Conexao();
        print_r($con);
    }
    else
    {
        header('Location: ../login/');
    }
?>