<?php

if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){
    header("Location: index.php?p=home");
}

?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmlogin" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-roxo font-weight-bold display-3">LOGUE-SE</p>
            <p class="text-center" style="font-size: 25px;">Página administrativa.</p>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" required>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="entrar" class="btn btn-lg btn-success" value="Entrar">
        </div>
    </div>
</form>
<?php

if(isset($_POST['entrar'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    include_once '../class/Admin.php';
    
    $admin = new Admin();

    if($admin->log($email, $senha)){
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Você entrou com sucesso.
        </div>
        <meta http-equiv="refresh" CONTENT="2;URL=?p=home">
        <?php
    }else{
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Usuário ou senha não coicidem.
        </div>
        <?php
    }

}

?>