<?php
    require_once("../../src/conn.php");

    $nome     = isset($_POST['nome']) ? $_POST['nome'] : '';
    $re       = isset($_POST['re']) ? $_POST['re'] : '';
    $email    = isset($_POST['mail']) ? $_POST['mail'] : '';
    $cel_corp = isset($_POST['cel_corp']) ? $_POST['cel_corp'] : '';
    $empresa  = isset($_POST['empresa']) ? $_POST['empresa'] : '';
    $contrato = isset($_POST['contrato']) ? $_POST['contrato'] : '';
    $cluster  = isset($_POST['cluster']) ? $_POST['cluster'] : '';
    $cargo    = isset($_POST['cargo']) ? $_POST['cargo'] : '';


    if(empty($nome))
    {
        print_r("NOME INVÁLIDO");
    }
    else if(empty($re))
    {
        print_r("RE INVÁLIDO");
    }
    else if(empty($email))
    {
        print_r("EMAIL INVÁLIDO");
    }
    else if(empty($cel_corp))
    {
        print_r("CELULAR CORPORATIVO INVÁLIDO");
    }
    else if(empty($empresa))
    {
        print_r("EMPRESA INVÁLIDO");
    }
    else if(empty($contrato))
    {
        print_r("CONTRATO INVÁLIDO");
    }
    else if(empty($cluster))
    {
        print_r("CLUSTER INVÁLIDO");
    }
    else if(empty($cargo))
    {
        print_r("CARGO INVÁLIDO");
    }
    else
    {
        $conexao = new Conexao();
        $stmt    = $conexao->conn();
        $query   = $stmt->prepare("UPDATE usuarios 
                                SET nome =:nome,
                                re =:re,
                                email =:email,
                                celular_corp =:cel_corp,
                                empresa =:empresa,
                                contrato =:contrato,
                                cluster =:cluster,
                                cargo =:cargo
                                WHERE email = '$email'");
        $query->bindParam(':nome', $nome);
        $query->bindParam(':re', $re);
        $query->bindParam(':email', $email);
        $query->bindParam(':cel_corp', $cel_corp);
        $query->bindParam(':empresa', $empresa);
        $query->bindParam(':contrato', $contrato);
        $query->bindParam(':cluster', $cluster);
        $query->bindParam(':cargo', $cargo);
        if($query->execute())
        {
            print_r(json_encode($email));
        }
        else
        {
            print_r('NÃO FOI SALVO');
        }
    }

?>