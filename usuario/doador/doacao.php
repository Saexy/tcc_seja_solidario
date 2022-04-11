<?php

if(isset($_COOKIE['logadodoador']) && $_COOKIE['logadodoador'] == 'sim'){

?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmdoacao" class="border" enctype="multipart/form-data">
    <div class="p-5">
        <div class="form-group">
            <p class="fonte-impact text-center texto-amarelo font-weight-bold display-3">DOAÇÃO</p>
        </div>
        <div class="form-group">
            <label for="tipodoacao">Tipo de Doação:</label>
            <select class="form-control" name="tipodoacao" id="tipodoacao" required>
                <option>Alimentícia</option>
                <option>Dinheiro</option>
                <option>Outros</option>
            </select>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" name="doar" class="btn btn-lg btn-success" value="Doar">
        </div>
    </div>
</form>

<?php

if(isset($_POST['doar'])){

    $tipodoacao = filter_input(INPUT_POST, 'tipodoacao', FILTER_SANITIZE_STRING);

    include_once '../class/Doador.php';

    $doador = new Doador($_COOKIE['iddoador']);

    echo "<script>window.open('https://wa.me/5511967744316?text=Olá%20equipe%20da%20seja%20solidário,%20gostaria%20de%20fazer%20uma%20doação%20do%20tipo%20$tipodoacao.%20Meus%20dados:%20$doador->nome%20-%20$doador->email%20-%20$doador->celular%20-%20$doador->endereco%20-%20$doador->numerocasa');</script>";

}
}else{
    header("Location: index.php?p=login");
}
?>

