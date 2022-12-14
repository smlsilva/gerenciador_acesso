<?php session_start()?>
<?php
    require_once("../../../conn_gerenciador_acesso/conn.php");

    $code = $_POST['code'];
    $email = $_SESSION['email'];
    
    if(!empty($code))
    {
        $conn = new Conexao();
        $stmt = $conn->conn();
        $stmt = $stmt->prepare("SELECT * FROM tb_emails_gerenciais WHERE MAIL =:email");
        $stmt->bindParam(':email', $email);

        if($stmt->execute())
        {
            $code2 = $stmt->fetch(PDO::FETCH_ASSOC)['CODE'];
            if($code == $code2)
            {
                $code = '';
                $stmt = new Conexao();
                $resp = $stmt->conn();
                $stmt = $resp->prepare("UPDATE tb_emails_gerenciais SET CODE=:code WHERE MAIL =:email");
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":code", $code);
                $stmt->execute();

                $_SESSION['verify'] = 2;

                echo 1;
            }
            else if($code != $code2)
            {
                echo 0;
            }
        }
    }
?>