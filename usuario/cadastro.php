<?php

if(isset($_COOKIE['logadodoador']) && $_COOKIE['logadodoador'] == 'sim'){
    header("Location: index.php?p=home");
}

if(isset($_COOKIE['logadodonatario']) && $_COOKIE['logadodonatario'] == 'sim'){
    header("Location: index.php?p=home");
}

?>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmcadastro" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-azul font-weight-bold display-3">CADASTRE-SE</p>
            <p class="text-center" style="font-size: 25px;">Caso você já tenha um cadastro, <a class="texto-azul" href="?p=login">clique aqui</a> para ir para a página de login.</p>
        </div>
        <div class="form-group">
            <label for="nome">Nome completo:</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>
        <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" name="celular" minlength="15" class="form-control" id="celular" onkeypress="maskCel(this);" onblur="maskCel(this);" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senha" required>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" name="endereco" id="endereco" required>
        </div>
        <div class="form-group">
            <label for="numero">Número da casa:</label>
            <input type="text" class="form-control" name="numero" id="numero" required>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select class="form-control" name="sexo" id="sexo">
                <option>Masculino</option>
                <option>Feminino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cadastrarcomo">Cadastrar como:</label>
            <select class="form-control" name="cadastrarcomo" id="cadastrarcomo">
                <option>Doador</option>
                <option>Donatário</option>
            </select>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="cadastrar" class="btn btn-lg btn-success" value="Cadastrar">
        </div>
    </div>
</form>
<?php

if(isset($_POST['cadastrar'])) {

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $numerocasa = filter_input(INPUT_POST, 'numerocasa', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

    $cadastrarcomo = filter_input(INPUT_POST, 'cadastrarcomo', FILTER_SANITIZE_STRING);

    if($cadastrarcomo == 'Doador'){
        include_once '../class/Doador.php';

        $doador = new Doador();
    
        if($doador->reg($nome, $celular, $email, $senha, $endereco, $numerocasa, $sexo)){
            ?>
            <div class="alert alert-success mt-3" role="alert">
                Você se cadastrou como Doador com sucesso. Você será redirecionado para a página de login.
            </div>
            <meta http-equiv="refresh" CONTENT="4;URL=?p=login">
            <?php
        }else{
            ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php
                
                if($doador->iderror == 1){
                    echo "Erro ao conectar no banco de dados.";
                }
                if($doador->iderror == 2){
                    echo "O email inserido já está cadastrado no sistema.";
                }
                if($doador->iderror == 3){
                    echo "O celular inserido já está cadastrado no sistema.";
                }
                
                ?>
            </div>
            <?php
        }
    }else{
        include_once '../class/Donatario.php';

        $donatario = new Donatario();
    
        if($donatario->reg($nome, $celular, $email, $senha, $endereco, $numerocasa, $sexo)){
            ?>
            <div class="alert alert-success mt-3" role="alert">
                Você se cadastrou como Donatário com sucesso. Você será redirecionado para a página de login.
            </div>
            <meta http-equiv="refresh" CONTENT="4;URL=?p=login">
            <?php
        }else{
            ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php
                
                if($donatario->iderror == 1){
                    echo "Erro ao conectar no banco de dados.";
                }
                if($donatario->iderror == 2){
                    echo "O email inserido já está cadastrado no sistema.";
                }
                if($donatario->iderror == 3){
                    echo "O celular inserido já está cadastrado no sistema.";
                }
                
                ?>
            </div>
            <?php
        }
    }
}

?>