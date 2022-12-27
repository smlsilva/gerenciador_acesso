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
        if($('#assunto').val() && $('#liberaAcesso').val() == 1 && !$("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").attr('hidden', 'hidden').val('');
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 1 && $("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").attr('hidden', 'hidden').val('');
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 2 && $("#bloquear").val() && $('#mensagem').val())
        {
            $(':button').removeAttr('disabled');
        }
        else if($('#assunto').val() && $('#liberaAcesso').val() == 2 && !$("#bloquear").val() && $('#mensagem').val())
        {
            $("#bloquear").removeAttr('hidden').val('');
            $(':button').attr('disabled', 'disabled');
        }
        else if($('#liberaAcesso').val() == 2 && !$("#bloquear").val())
        {
            $("#bloquear").removeAttr('hidden').val('');
        }
        else if(!$('#liberaAcesso').val() || $('#liberaAcesso').val() == 1)
        {
            $("#bloquear").attr('hidden','hidden').val('');
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
                mensagem: $('#mensagem').val(),
                bloquear: $("#bloquear").val()
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
                        if(e == 201)
                        {
                            alert("JÁ FOI LIBERADO");
                        }
                        else if(e == 202)
                        {
                            alert("BLOQUEADO COM SUCESSO!");
                        }
                        else if(e == 204)
                        {
                            alert("JÁ ESTÁ BLOQUEADO");
                        }
                        else if(e == 222)
                        {
                            alert("EXECUTADO COM SUCESSO");
                        }
                        else if(e == 404)
                        {
                            alert("NÃO FOI PREENCHIDO CORRETAMENTE");
                        }
                    },
                    error: function(e)
                    {
                        if(e == 200)
                        {
                            alert("ATUALIZADO COM SUCESSO!");
                        }
                    }
                })
            }
            else
            {
                window.location.href = './';
            }
        }
    }
    
    $('.back_table').click(function(e)
    {
        $(".form_sendMail").attr('hidden', 'hidden').css('display', 'none').css('flex-direction', 'column').css('margin', '30px').css('width', '30vw');;
        $(".table-full").removeAttr('hidden')
    })
</script>