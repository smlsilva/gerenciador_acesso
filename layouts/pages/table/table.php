<?php
    require_once("./src/conn.php");
    $conexao = new Conexao();
    $stmt = $conexao->conn();
    $resp = $stmt->prepare("SELECT * FROM usuarios WHERE active = 0 AND perfil != 2");
    $resp->execute();
    $datas = '';
?>
SISTEMA DE CONTROLE DE ACESSO
<div style="width: 100%; overflow: auto;">
    <table style="font-size: 18px; font-family: sans-serif; width: 80%; background-color: #999; margin: 10px;">
        <thead style="background-color: #235;">
            <tr>
                <th>EMPRESA</th>
                <th>CONTRATO</th>
                <th>CLUSTER</th>
                <th>CARGO</th>
                <th>NOME</th>
                <th>RE</th>
                <th>EMAIL</th>
                <th>CELULAR CORP</th>
            </tr>
        </thead>
        <tbody id="table" style="background-color: #bbb;color: #000;">
            <?php while($data = $resp->fetch(PDO::FETCH_ASSOC)) {?>
                <?php
                $datas .= "
                <tr onclick='upgradeStatus(this)' style='cursor: pointer;'>
                    <td>{$data['empresa']}</td>
                    <td>{$data['contrato']}</td>
                    <td>{$data['cluster']}</td>
                    <td>{$data['cargo']}</td>
                    <td>{$data['nome']}</td>
                    <td>{$data['re']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['celular_corp']}</td>
                </tr>";
                ?>
            <?php }?>
            <?php echo $datas?>
        </tbody>
    </table>
</div>
<script>
    function upgradeStatus(e)
    {
        const email = [e][0].children[6].innerText;
        const nome  = [e][0].children[4].innerText;
        let resp = window.confirm('Você quer liberar ' + nome + ' ?');
        
        if(resp)
        {
            $.ajax({
                url: './sql/liberarAcesso.php',
                method: 'post',
                data: {mail: email},
                dataType: 'json',
                success: function(e)
                {
                    if(e == 1)
                    {
                        alert('Liberado com Sucesso!');
                        window.location.href = './';
                    }
                    else if(e == 0)
                    {
                        alert('Error ao Liberar!');
                    }
                },
                error: function(e)
                {
                    // ERROR
                }
            })
        }
        else
        {
            window.location.href = './';
        }
    }
</script>