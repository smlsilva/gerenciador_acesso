<?php
    require_once("../../src/conn.php");
    $email = $_POST['mail'];

    $conexao = new Conexao();
    $stmt    = $conexao->conn();
    $query   = $stmt->prepare("SELECT * FROM usuarios WHERE email = '$email'");
    $query->execute();
    
    $nome = '';
    $re = '';
    $email = '';
    $cel_corp = '';
    $empresa = '';
    $contrato = '';
    $cluster = '';
    $cargo = '';

    while($valores = $query->fetch(PDO::FETCH_ASSOC))
    {
        $nome = $valores['nome'];
        $re = $valores['re'];
        $email = $valores['email'];
        $cel_corp = $valores['celular_corp'];
        $empresa = $valores['empresa'];
        $contrato = $valores['contrato'];
        $cluster = $valores['cluster'];
        $cargo = $valores['cargo'];
    }

    print_r(json_encode([$nome, $re, $email, $cel_corp, $empresa, $contrato, $cluster, $cargo]));
?>