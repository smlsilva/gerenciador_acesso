<p class="back_table" style="width: 40%;">VOLTAR</p>
<div class="container-form">
    <form>
        <input type="text" placeholder="NOME">
        <input type="text" placeholder="RE">
        <input type="text" placeholder="E-MAIL">
        <input type="text" placeholder="CELULAR CORP">
        <input type="text" placeholder="EMPRESA">
        <input type="text" placeholder="CONTRATO">
        <input type="text" placeholder="CLUSTER">
        <input type="text" placeholder="CARGO">
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
    }

    function salvar()
    {
        $(".editar").removeAttr("hidden");
        $(".submit").attr("hidden", "hidden");
    }
</script>