<?php

include_once "../class/Donatario.php";

if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){

    $id = '1';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $donatario = new Donatario($id);

    if(!$donatario->exists()){
        header("Location: index.php?p=home");
    }

?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmedit" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-roxo font-weight-bold display-3">EDITAR DADOS</p>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <?php echo '<input type="text" class="form-control" name="endereco" id="endereco" value="'.$donatario->endereco.'" required>'; ?>
        </div>
        <div class="form-group">
            <label for="numerocasa">Número da casa:</label>
            <?php echo '<input type="text" class="form-control" name="numerocasa" id="numerocasa" value="'.$donatario->numerocasa.'" required>'; ?>
        </div>
        <div class="form-group">
            <label for="sexo">Sexo:</label>
            <select class="form-control" name="sexo" id="sexo">
                <?php echo "<option selected hidden>$donatario->sexo</option>"; ?>
                <option>Masculino</option>
                <option>Feminino</option>
            </select>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="salvar" class="btn btn-lg btn-success" value="Salvar">
        </div>
    </div>
</form>

<?php

if(isset($_POST['salvar'])) {

    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
    $numerocasa = filter_input(INPUT_POST, 'numerocasa', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);

    if($donatario->edit($endereco, $numerocasa, $sexo)){
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Você editou os dados com sucesso.
        </div>
        <?php
        echo '<meta http-equiv="refresh" CONTENT="2;URL=?p=donatario/profile&id='.$donatario->id.'">';
    }else{
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Erro ao conectar no banco de dados.
        </div>
        <?php
    }
}

?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmadicionar" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-amarelo font-weight-bold display-3">ADICIONAR DOAÇÃO RECEBIDA</p>
        </div>
        <div class="form-group">
            <label for="tipodoacao">Tipo de Doação:</label>
            <select class="form-control" name="tipodoacao" id="tipodoacao">
                <option>Alimentícia</option>
                <option>Dinheiro</option>
                <option>Outros</option>
            </select>
        </div>
        <div class="form-group">
            <label for="detalhes">Detalhes:</label>
            <input type="text" placeholder="Ex: R$100,00, 1L Óleo, 50 Camisas..." class="form-control" name="detalhes" id="detalhes" required>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="adicionar" class="btn btn-lg btn-success" value="Adicionar">
        </div>
    </div>
</form>

<?php

if(isset($_POST['adicionar'])) {

    $tipodoacao = filter_input(INPUT_POST, 'tipodoacao', FILTER_SANITIZE_STRING);
    $detalhes = filter_input(INPUT_POST, 'detalhes', FILTER_SANITIZE_STRING);

    if($donatario->addDonate($tipodoacao, $detalhes)){
        ?>
        <div class="alert alert-success mt-3" role="alert">
            Você adicionou uma doação recebida com sucesso.
        </div>
        <?php
        echo '<meta http-equiv="refresh" CONTENT="2;URL=?p=donatario/profile&id='.$donatario->id.'">';
    }else{
        ?>
        <div class="alert alert-danger mt-3" role="alert">
            Erro ao conectar no banco de dados.
        </div>
        <?php
    }
}

?>

<div class="col-md-12 border mt-5">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-azul text-center display-4">HISTÓRICO DE DOAÇÕES RECEBIDAS</p>

        <?php

        if($donatario->historyDonate()){

            $list = $donatario->list;
            foreach($list as $history){
                ?>

                <div class="row border mt-4">
                    <div class="col-md-9 mt-2 mb-2 ml-2">
                        <span class="text-left" style="font-size: 20px;"><?php echo "Data da doação: $history[3] - Tipo: $history[2] - Detalhes da doação: $history[4]"; ?></span>
                    </div>
                    <div class="col-md-2 ml-5 d-flex justify-content-end align-items-center mt-2 mb-2">
                        <?php echo '<a class="text-center texto-azul" href="?p=donatario/editdonate&id='.$history[1].'&id_doacao='.$history[0].'"><i class="material-icons align-middle">edit</i> Editar</a>'; ?>
                    </div>
                </div>

                <?php
            }

        }else{
            ?>
            <div class="border p-5">
                <p class="text-center texto-vermelho" style="font-size: 22.5px;">Este usuário não recebeu nenhuma doação.</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php

}else{
    header("Location: index.php?p=login");
}
?>