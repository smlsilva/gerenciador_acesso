<style>
    <?php require_once("./layouts/header/index.css") ?>
</style>
<header class="cabecalho">
    <ul>
        <li><a href="https://suportespi.com.br/" target="__blank">Portal SPI</a></li>
        <li><a href="https://suportespi.com.br/login/" target="__blank">Login</a></li>
        <li><a href="https://suportespi.com.br/login/cadastrar_usuario.php" target="__blank">Cadastrar</a></li>
        <li><a href="/suporte/" target="__blank">Suporte</a></li>
        <?php if(isset($_SESSION['verify']) && $_SESSION['verify'] == 2) {?>
            <li style="cursor: pointer;" onclick="logout();"><a>Sair</a></li>
        <?php }?>
    </ul>
</header>
<script>
    function logout()
    {
        $.ajax({
            url: './layouts/pages/logout/logout.php',
            success: function(e)
            {
                window.location.href = './';
            }
        })
    }
</script>