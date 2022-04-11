<?php

include_once "../class/Donatario.php";

if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){

    $id = '1';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $id_doacao = '1';
    if(isset($_GET['id_doacao'])){
        $id_doacao = $_GET['id_doacao'];
    }

    $donatario = new Donatario($id);

    if(!$donatario->exists()){
        header("Location: index.php?p=home");
    }

    if(!$donatario->existsDonate($id_doacao)){
        header("Location: index.php?p=home");
    }

    $return = $donatario->getDonate($id_doacao);

    foreach($return as $donate){}

?>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmeditar" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-amarelo font-weight-bold display-3">EDITAR DOAÇÃO RECEBIDA</p>
        </div>
        <div class="form-group">
            <label for="tipodoacao">Tipo de Doação:</label>
            <select class="form-control" name="tipodoacao" id="tipodoacao">
                <?php echo "<option selected hidden>$donate[2]</option>"; ?>
                <option>Alimentícia</option>
                <option>Dinheiro</option>
                <option>Outros</option>
            </select>
        </div>
        <div class="form-group">
            <label for="detalhes">Detalhes:</label>
            <?php echo '<input type="text" placeholder="Ex: R$100,00, 1L Óleo, 50 Camisas..." class="form-control" name="detalhes" id="detalhes" value="'.$donate[4].'" required>'; ?>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="salvar" class="btn btn-lg btn-success" value="Salvar">
            <input type="submit" name="excluir" class="btn btn-lg btn-danger ml-5" value="Excluir doação">
        </div>
    </div>
</form>

<?php

    if(isset($_POST['salvar'])) {

        $tipodoacao = filter_input(INPUT_POST, 'tipodoacao', FILTER_SANITIZE_STRING);
        $detalhes = filter_input(INPUT_POST, 'detalhes', FILTER_SANITIZE_STRING);

        if($donatario->editDonate($id_doacao, $tipodoacao, $detalhes)){
            ?>
            <div class="alert alert-success mt-3" role="alert">
                Você editou a doação recebida com sucesso.
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
    if(isset($_POST['excluir'])) {

        $tipodoacao = filter_input(INPUT_POST, 'tipodoacao', FILTER_SANITIZE_STRING);
        $detalhes = filter_input(INPUT_POST, 'detalhes', FILTER_SANITIZE_STRING);

        if($donatario->deleteDonate($id_doacao)){
            ?>
            <div class="alert alert-success mt-3" role="alert">
                Você excluiu a doação recebida com sucesso.
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
}else{
    header("Location: index.php?p=login");
}
?>