CÓDIGO ENVIADO
<div class="container-form">
    <form method="POST">
        <input type="text" name="text" id="text" placeholder="Código Aqui" onchange="verificationInput()">
        <span class="alert" hidden>Código Incorreto</span>
    </form>
</div>
<script>
    function verificationInput()
    {
        if($("#text").val() == '')
        {
            $(".alert").attr('hidden', 'hidden')
            $("#text").css('border', '1px solid'); 
        }
        else if($("#text").val() != '')
        {
            $.ajax({
                url: './sql/verficacaoCode.php',
                method: 'post',
                data: {code: $("#text").val()},
                dataType: 'json',
                success: function (e)
                {
                    if(e == 1)
                    {
                        $(".alert").attr('hidden', 'hidden')
                        $("#text").css('border', '2px solid #0f0'); 
                        window.location.href = './';
                    }
                    else if(e == 0)
                    {
                        $(".alert").removeAttr('hidden').css('color', '#f00')
                        $("#text").css('border', '2px solid #f00');
                    }
                },
                error: function(e)
                {
                    console.log(e.responseText)
                }
            })
        }
    }
</script>