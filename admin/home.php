<?php

if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){

?>

<div class="col-md-12 border">
    <div class="p-5">
        <p class="fonte-impact text-center texto-roxo font-weight-bold display-3">DOADORES</p>
        <p class="text-center" style="font-size: 25px;">Página para visualizar, adicionar,remover e editar doações de doadores.</p>
        <div class="d-flex justify-content-center">
            <a href="?p=doador/list" class="btn btn-lg btn-info">Abrir</a>
        </div>
    </div>
</div>

<div class="col-md-12 border mt-5">
    <div class="p-5">
        <p class="fonte-impact text-center texto-azul font-weight-bold display-3">DONATÁRIOS</p>
        <p class="text-center" style="font-size: 25px;">Página para visualizar, adicionar,remover e editar doações recebidas de donatários.</p>
        <div class="d-flex justify-content-center">
            <a href="?p=donatario/list" class="btn btn-lg btn-info">Abrir</a>
        </div>
    </div>
</div>


<?php

}else{
    header("Location: index.php?p=login");
}
?>
