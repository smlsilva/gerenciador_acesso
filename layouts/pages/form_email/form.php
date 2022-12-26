<style>
    <?php
        require_once('./layouts/pages/form_email/form_style.css');
    ?>
</style>
<p class="back_table" style="width: 40%;">VOLTAR</p>
<input type="email" readonly name="maildesc" id="maildesc" placeholder="Destinatário">
<input type="text" name="assunto" id="assunto" placeholder="Assunto" onchange="verificaConteudo()">
<select name="liberaAcesso" id="liberaAcesso" onchange="verificaConteudo()">
    <option value="">DESEJA LIBERAR O ACESSO ?</option>
    <option value="1">Sim</option>
    <option value="2">Não</option>
</select>
<select name="bloquear" id="bloquear" hidden onchange="verificaConteudo()">
    <option value="">DESEJA BLOQUEAR O ACESSO ?</option>
    <option value="1">Sim</option>
    <option value="2">Não</option>
</select>
<textarea name="mensagem" id="mensagem" cols="30" rows="10" onchange="verificaConteudo()"></textarea>
<input disabled type="button" value="Enviar" onclick="liberarAcesso()">

<script>
    function verificaConteudo()
    {
        const valores = {
            assunto: $('#assunto').val(),
            acessoLiberado: $('#liberaAcesso').val(),
            mensagem: $('#mensagem').val()
        }

        if($('#assunto').val() && $('#liberaAcesso').val() == 1 && !$("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").attr('hidden', 'hidden');
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 1 && $("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").attr('hidden', 'hidden');
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 2 && $("#bloquear").val() && $('#mensagem').val())
        {
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 2 && !$("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").removeAttr('hidden')
            $(':button').attr('disabled', 'disabled');
        }
    }

    function liberarAcesso()
    {
        if(!$('#maildesc').val())
        {
            alert("EMAIL INEXISTENTE!");
        }
        else if($('#maildesc').val())
        {
            let dados = {
                email: $('#maildesc').val(),
                assunto: $('#assunto').val(),
                acessoLiberado: $('#liberaAcesso').val(),
                mensagem: $('#mensagem').val()
            }
            
            let resp = window.confirm('Você quer liberar o email ' + dados.email + ' ?');
            
            if(resp)
            {
                $.ajax({
                    url: './sql/liberarAcesso.php',
                    method: 'post',
                    data: dados,
                    dataType: 'json',
                    success: function(e)
                    {
                        console.log(e)
                        // if(e == 1)
                        // {
                        //     alert('Liberado com Sucesso!');
                        //     window.location.href = './';
                        // }
                        // else if(e == 0)
                        // {
                        //     alert('Error ao Liberar!');
                        // }
                    },
                    error: function(e)
                    {
                        console.log(e)
                    }
                })
            }
            else
            {
                // window.location.href = './';
            }
        }
    }
    
    $('.back_table').click(function(e)
    {
        $(".form_sendMail").attr('hidden', 'hidden').css('display', 'none').css('flex-direction', 'column').css('margin', '30px').css('width', '30vw');;
        $(".table-full").removeAttr('hidden')
    })
</script>