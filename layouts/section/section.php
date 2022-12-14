<style>
    <?php require_once("./layouts/section/index.css")?>
</style>
<?php if(empty($_SESSION['verify'])) {?>
    <section>
        <?php require_once("./layouts/pages/controleAcess/controleAcess.php"); ?>
    </section>
<?php } else if($_SESSION['verify'] == 1) {?>
    <section>
        <?php require_once("./layouts/pages/auth/auth.php"); ?>
    </section>
<?php } else if($_SESSION['verify'] == 2) {?>
    <section>
        <?php require_once("./layouts/pages/table/table.php"); ?>
    </section>
<?php }?>