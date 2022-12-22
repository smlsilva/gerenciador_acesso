<?php
    require_once("./src/conn.php");
    $conexao = new Conexao();
    $stmt = $conexao->conn();
    $resp = $stmt->prepare("SELECT * FROM usuarios WHERE active = 0 AND perfil != 2");
    $resp->execute();
    $datas = '';
?>
SISTEMA DE CONTROLE DE ACESSO
<div style="display: flex; justify-content: center;">
    <table class="table-full" style="font-size: 0.9rem; font-family: sans-serif; width: 80%; background-color: #999; margin: 10px;">
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
                <th>EXCLUIR</th>
                <th>EDITAR</th>
                <th>ENVIAR EMAIL</th>
            </tr>
        </thead>
        <tbody id="table" style="background-color: #bbb;color: #000; text-align: center;">
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
                    <td><i class='bx bx-trash-alt' style='color: #f00;'></i></td>
                    <td><i class='bx bx-calendar-edit' style='color: #ffa500;'></i></td>
                    <td onclick='showForm()'><i class='bx bxs-send' style='color: #0cb;'></i></td>
                </tr>";
                ?>
            <?php }?>
            <?php echo $datas?>
        </tbody>
    </table>
    <div class="form_sendMail" hidden>
        <?php require_once("./layouts/pages/form/form.php") ?>
    </div>
</div>
<script>
    function showForm(email)
    {
        $(".form_sendMail").removeAttr('hidden').css('display', 'flex').css('flex-direction', 'column').css('margin', '30px').css('width', '30vw');
        $("#maildesc").val(`${email}`);
        $(".table-full").attr('hidden', 'hidden')
    }

    function upgradeStatus(e)
    {
        const email = [e][0].children[6].innerText;
        const nome  = [e][0].children[4].innerText;
        showForm(email)
    }
</script>