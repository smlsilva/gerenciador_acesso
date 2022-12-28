<style>
    <?php
        require_once("./layouts/pages/table/table.css");
    ?>
</style>
<?php
    require_once("./src/conn.php");
    $conexao = new Conexao();
    $stmt = $conexao->conn();
    $resp = $stmt->prepare("SELECT * FROM usuarios WHERE active = 0 AND perfil != 2");
    $resp->execute();
    $datas = '';
?>
<div style="display: flex; justify-content: center;">
    <table class="table-full">
        <thead style="background-color: #235;">
            <tr style="height: 5vh;">
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
                <th>SOBRE ACESSO</th>
            </tr>
        </thead>
        <tbody id="table" style="background-color: #bbb;color: #000; text-align: center;">
            <?php while($data = $resp->fetch(PDO::FETCH_ASSOC)) {?>
                <?php
                $datas .= "
                <tr style='height: 5vh;'>
                    <td>{$data['empresa']}</td>
                    <td>{$data['contrato']}</td>
                    <td>{$data['cluster']}</td>
                    <td>{$data['cargo']}</td>
                    <td>{$data['nome']}</td>
                    <td>{$data['re']}</td>
                    <td>{$data['email']}</td>
                    <td>{$data['celular_corp']}</td>
                    <td><i class='bx bx-trash-alt' style='color: #f00;'></i></td>
                    <td onclick='showFormEdit(this)' style='cursor: pointer;' value='{$data['email']}'><i class='bx bx-calendar-edit' style='color: #ffa500;'></i></td>
                    <td onclick='upgradeStatus(this)' style='cursor: pointer;' value='{$data['email']}'><i class='bx bxs-send' style='color: #0cb;'></i></td>
                </tr>";
                ?>
            <?php }?>
            <?php echo $datas?>
        </tbody>
    </table>
    <div class="form_sendMail" hidden>
        <?php require_once("./layouts/pages/form_email/form.php"); ?>
    </div>
    <div class="form_edit" hidden>
        <?php require_once("./layouts/pages/form_edit/form_edit.php"); ?>
    </div>
</div>
<script>
    function showForm(email)
    {
        $(".form_sendMail").removeAttr('hidden').css('display', 'flex').css('flex-direction', 'column');
        $("#maildesc").val(`${email}`);
        $(".table-full").attr('hidden', 'hidden')
    }

    function showFormEdit(edit)
    {
        $(".form_sendMail").attr('hidden', 'hidden');
        $(".table-full").attr('hidden', 'hidden');
        $(".form_edit").removeAttr('hidden', 'hidden');
        const email = $(edit)[0].attributes[2].value;
    }

    function upgradeStatus(e)
    {
        const email = $(e)[0].attributes[2].value;
        showForm(email)
    }

    $("#emailRegistrado").change(function ()
    {
        $.ajax({
            url:'./src/ajax/buscarPorEmail.php',
            method: 'post',
            data: {email: this.value},
            dataType: 'json',
            success: function(e)
            {
                console.log(e.innerText);
            },
            error: function(e)
            {
                $("#table").html(e.responseText)
            }
        })
    })
</script>