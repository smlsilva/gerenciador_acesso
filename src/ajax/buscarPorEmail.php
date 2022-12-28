<?php
    require_once("../../src/conn.php");

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if(isset($email))
    {
        $conn = new Conexao();
        $stmt = $conn->conn();
        $stmt = $stmt->prepare("SELECT * FROM usuarios WHERE email =:email");
        $stmt->bindParam(':email', $email);
        if($stmt->execute())
        {
            $usuario = '';
            while($usuarioSelecionado = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $usuario .= "
                <tr style='height: 5vh;'>
                    <td>{$usuarioSelecionado['empresa']}</td>
                    <td>{$usuarioSelecionado['contrato']}</td>
                    <td>{$usuarioSelecionado['cluster']}</td>
                    <td>{$usuarioSelecionado['cargo']}</td>
                    <td>{$usuarioSelecionado['nome']}</td>
                    <td>{$usuarioSelecionado['re']}</td>
                    <td>{$usuarioSelecionado['email']}</td>
                    <td>{$usuarioSelecionado['celular_corp']}</td>
                    <td><i class='bx bx-trash-alt' style='color: #f00;'></i></td>
                    <td onclick='showFormEdit(this)' style='cursor: pointer;' value='{$usuarioSelecionado['email']}'><i class='bx bx-calendar-edit' style='color: #ffa500;'></i></td>
                    <td onclick='upgradeStatus(this)' style='cursor: pointer;' value='{$usuarioSelecionado['email']}'><i class='bx bxs-send' style='color: #0cb;'></i></td>
                </tr>";
            }
            if(!empty($usuario))
            {
                echo $usuario;
            }
            else if(empty($usuario))
            {
                $conn = new Conexao();
                $stmt = $conn->conn();
                $resp = $stmt->prepare("SELECT * FROM usuarios WHERE active = 0 AND perfil != 2");
                if($resp->execute())
                {
                    while($usuarios = $resp->fetch(PDO::FETCH_ASSOC))
                    {
                        $usuario .= "
                        <tr style='height: 5vh;'>
                            <td>{$usuarios['empresa']}</td>
                            <td>{$usuarios['contrato']}</td>
                            <td>{$usuarios['cluster']}</td>
                            <td>{$usuarios['cargo']}</td>
                            <td>{$usuarios['nome']}</td>
                            <td>{$usuarios['re']}</td>
                            <td>{$usuarios['email']}</td>
                            <td>{$usuarios['celular_corp']}</td>
                            <td><i class='bx bx-trash-alt' style='color: #f00;'></i></td>
                            <td><i class='bx bx-calendar-edit' style='color: #ffa500;'></i></td>
                            <td onclick='upgradeStatus(this)' style='cursor: pointer;' value='{$usuarios['email']}'><i class='bx bxs-send' style='color: #0cb;'></i></td>
                        </tr>";
                    }
                    echo $usuario;
                }
            }
        }
    }
    else
    {
        echo 0;
    }
?>