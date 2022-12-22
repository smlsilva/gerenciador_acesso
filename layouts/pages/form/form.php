<style>
    <?php
        require_once('./layouts/pages/form/form_style.css');
    ?>
</style>
<p>Voltar</p>
<input type="email" readonly name="maildesc" id="maildesc" placeholder="Destinatário">
<input type="text" name="assunto" id="assunto" placeholder="Assunto">
<select name="liberaAcesso" id="liberaAcesso">
    <option value="">Vai liberar o Acesso ?</option>
    <option value="1">Sim</option>
    <option value="2">Não</option>
</select>
<textarea name="mensagem" id="mensagem" cols="30" rows="10"></textarea>
<input type="submit" value="Enviar" onclick="liberarAcesso()">

<script>
    function liberarAcesso()
    {
        const dados = {
            email: $('#maildesc').val(),
            assunto: $('#assunto').val(),
            acessoLiberado: $('#liberaAcesso').val(),
            mensagem: $('#mensagem').val()
        }

        // let resp = window.confirm('Você quer liberar ' + nome + ' ?');
        
        // if(resp)
        // {
        //     $.ajax({
        //         url: './sql/liberarAcesso.php',
        //         method: 'post',
        //         data: {mail: email},
        //         dataType: 'json',
        //         success: function(e)
        //         {
        //             if(e == 1)
        //             {
        //                 alert('Liberado com Sucesso!');
        //                 window.location.href = './';
        //             }
        //             else if(e == 0)
        //             {
        //                 alert('Error ao Liberar!');
        //             }
        //         },
        //         error: function(e)
        //         {
        //             // ERROR
        //         }
        //     })
        // }
        // else
        // {
        //     window.location.href = './';
        // }
    }
</script>