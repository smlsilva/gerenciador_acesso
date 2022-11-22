<style>
    <?php require_once("./layouts/section/index.css")?>
</style>
<section>
    SISTEMA DE CONTROLE DE ACESSO
    <div class="container-form">
        <form onsubmit="verificationInput(event, this)">
            <input type="email" name="email" id="email" placeholder="Digite o seu E-mail" onchange="verificationInput()">
            <span class="alert" hidden>E-mail não existe</span>
            <input type="password" name="pass" id="pass" placeholder="Digite a sua Senha" onchange="verificationInput()">
            <input type="submit" class="disabled" value="Entrar" id="entrar" disabled>
        </form>
    </div>
</section>
<script>
    function verificationInput(event, e)
    {
        event.preventDefault();
        
        if($("#email").val() == '' || $("#pass").val() == '')
        {
            $(".alert").attr('hidden', 'hidden')
            $("#email").css('border', '1px solid'); 
            $("#entrar").attr('disabled', 'disabled').removeClass('habilited').addClass('disabled');
        }
        else if($("#email").val() != '' && $("#pass").val() != '')
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
                        $("#entrar").removeAttr('disabled').removeClass('disabled').addClass('habilited');
                    }
                    else if(e == 0)
                    {
                        $(".alert").removeAttr('hidden').css('color', '#f00')
                        $("#email").css('border', '2px solid #f00');
                        $("#entrar").attr('disabled', 'disabled').removeClass('habilited').addClass('disabled'); 
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