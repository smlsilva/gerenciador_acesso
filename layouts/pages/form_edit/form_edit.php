<p class="back_table" style="width: 40%;">VOLTAR</p>
<div class="container-form">
    <form>
        <input type="text" id="nome" placeholder="NOME" readonly>
        <input type="text" id="re" placeholder="RE" readonly>
        <input type="text" id="email" placeholder="E-MAIL" readonly>
        <input type="text" id="cel_corp" placeholder="CELULAR CORP" readonly>
        <input type="text" id="empresa" placeholder="EMPRESA" readonly>
        <input type="text" id="contrato" placeholder="CONTRATO" readonly>
        <input type="text" id="cluster" placeholder="CLUSTER" readonly>
        <input type="text" id="cargo" placeholder="CARGO" readonly>
        <div style="padding: 10px 0 0 0;">
            <div class="editar" onclick="editar()">EDITAR</div>
            <div class="submit" onclick="salvar()" hidden>SALVAR</div>
        </div>
    </form>
</div>
<script>
    $('.back_table').click(function(e)
    {
        $(".form_edit").attr('hidden', 'hidden');
        $(".table-full").removeAttr('hidden')
    })

    function editar()
    {
        $(".editar").attr("hidden", "hidden");
        $(".submit").removeAttr("hidden");
        $("#nome").removeAttr('readonly');
        $("#re").removeAttr('readonly');
        $("#email").removeAttr('readonly');
        $("#cel_corp").removeAttr('readonly');
        $("#empresa").removeAttr('readonly');
        $("#contrato").removeAttr('readonly');
        $("#cluster").removeAttr('readonly');
        $("#cargo").removeAttr('readonly');
    }

    function salvar()
    {
        if(!$("#nome").val() && !$("#re").val() && !$("#email").val() && !$("#cel_corp").val() && !$("#empresa").val() && !$("#contrato").val() && !$("#cluster").val() && !$("#cargo").val())
        {

        }
        else if(!$("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {

        }
        else if($("#nome").val() && !$("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && !$("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && !$("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && !$("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && !$("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && !$("#cluster").val() && $("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && !$("#cargo").val())
        {
            
        }
        else if($("#nome").val() && $("#re").val() && $("#email").val() && $("#cel_corp").val() && $("#empresa").val() && $("#contrato").val() && $("#cluster").val() && $("#cargo").val())
        {
            $(".editar").removeAttr("hidden");
            $(".submit").attr("hidden", "hidden");
            $("#nome").attr('readonly', 'readonly');
            $("#re").attr('readonly', 'readonly');
            $("#email").attr('readonly', 'readonly');
            $("#cel_corp").attr('readonly', 'readonly');
            $("#empresa").attr('readonly', 'readonly');
            $("#contrato").attr('readonly', 'readonly');
            $("#cluster").attr('readonly', 'readonly');
            $("#cargo").attr('readonly', 'readonly');
            
            const dados = {
            nome : $("#nome").val(),
            re: $("#re").val(),
            email: $("#email").val(),
            cel_corp: $("#cel_corp").val(),
            empresa: $("#empresa").val(),
            contrato: $("#contrato").val(),
            cluster: $("#cluster").val(),
            cargo: $("#cargo").val()
            }

            $.ajax({
                url: './src/ajax/salvar.php',
                data: dados,
                dataType: 'json',
                method: 'post',
                success: function(e)
                {
                    console.log("SUCESSO " + e)
                },
                error: function(e)
                {
                    console.log("ERROR " + e)
                }
            })
        }
        else
        {
            alert("VERIFIQUE OS CAMPOS");
        }
    }
</script>