<?php

    session_start();
?>
<?php include "../partials/header.php" ?>

<div class="container mt-5">
    <form action="valida.php" method="POST">
    <h1 class="text-center">Login Administrador</h1>
    <div class="form-group">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control" name="inputEmail" placeholder="Digite seu email">
    </div>
    <div class="form-group">
        <label for="inputSenha">Senha</label>
        <input type="password" class="form-control" name="inputSenha" placeholder="Digite sua Senha">
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
    </form>
    <?php if(isset($_SESSION['msg'])){
        echo '<h3 class="text-danger">' . $_SESSION['msg'] . '</h3>';
        unset($_SESSION['msg']);
    }
    ?>
</div>
<?php include "../partials/footer.php" ?>