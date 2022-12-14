SISTEMA DE CONTROLE DE ACESSO
<div class="container-form">
    <form method="POST">
        <input type="email" name="email" id="email" placeholder="Digite o seu E-mail" onchange="verificationInput()">
        <span class="alert" hidden>E-mail não existe</span>
    </form>
</div>
<script>
    function verificationInput()
    {
        if($("#email").val() == '')
        {
            $(".alert").attr('hidden', 'hidden')
            $("#email").css('border', '1px solid'); 
            $("#entrar").attr('disabled', 'disabled').removeClass('habilited').addClass('disabled');
        }
        else if($("#email").val() != '')
        {
            $.ajax({
                url: './sql/verificacaoEmail.php',
                method: 'post',
                data: {email: $("#email").val()},
                dataType: 'json',
                success: function (e)
                {
                    if(e == 1)
                    {
                        $(".alert").attr('hidden', 'hidden')
                        $("#email").css('border', '2px solid #0f0'); 

                        $.ajax({
                            url: './sql/codeSendSystem.php',
                            method: 'post',
                            dataType: 'json',
                            success: function (e)
                            {
                                window.location.href = './';
                            },
                            error: function(e)
                            {
                                console.log(e)
                            }
                        })

                    }
                    else if(e == 0)
                    {
                        $(".alert").removeAttr('hidden').css('color', '#f00')
                        $("#email").css('border', '2px solid #f00');
                    }
                },
                error: function(e)
                {
                    console.log(e)
                }
            })
        }
    }
</script>