<?php

if(isset($_COOKIE['logadodoador']) && $_COOKIE['logadodoador'] == 'sim'){

?>

<div class="col-md-12 border">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-amarelo text-center display-4">FAÇA SUA DOAÇÃO</p>
        <p class="text-center" style="font-size: 22.5px;">Ao doar você pode salvar uma vida, e tirar uma família da fome.</p>
        <p class="text-center" style="font-size: 22.5px;">Cada doação será registrada em seu histórico de doações, e você poderá ver a categoria que foi realizada a doação.</p>
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <a href="?p=doador/doacao" class="btn btn-lg btn-info">FAZER DOAÇÃO</a>
        </div>
    </div>
</div>
    
<div class="col-md-12 border mt-5">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-azul text-center display-4">HISTÓRICO DE DOAÇÕES</p>
        
        <?php
        
        include_once '../class/Doador.php';

        $doador = new Doador($_COOKIE['iddoador']);
        
        if($doador->historyDonate()){

            $list = $doador->list;
            foreach($list as $history){
                ?>

                <div class="border mt-4">
                    <div class="ml-2 mt-2">
                        <p class="text-left" style="font-size: 20px;"><?php echo "Data da doação: $history[3] - Tipo: $history[2] - Detalhes da doação: $history[4]"; ?></p>
                    </div>
                </div>

                <?php
            }

        }else{
            ?>
            <div class="border p-5">
                <p class="text-center texto-vermelho" style="font-size: 22.5px;">Você ainda não realizou nenhuma doação.</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php

}else{
    if(isset($_COOKIE['logadodonatario']) && $_COOKIE['logadodonatario'] == 'sim'){

    include_once '../class/Donatario.php';

    $donatario = new Donatario($_COOKIE['iddonatario']);
?>

<div class="col-md-12 border">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-amarelo text-center display-4">PEÇA UMA DOAÇÃO</p>
        <p class="text-center" style="font-size: 22.5px;">Cada doação recebida será registrada em seu histórico de doações, e você poderá ver a data, tipo e os detalhes da doação.</p>
        <div class="col-md-12 d-flex justify-content-center align-items-center">
            <?php echo '<a target="_blank" href="https://wa.me/5511967744316?text=Olá%20equipe%20da%20seja%20solidário,%20gostaria%20de%20pedir%20uma%20doação.%20Meus%20dados:%20'.$donatario->nome.'%20-%20'.$donatario->email.'%20-%20'.$donatario->celular.'%20-%20'.$donatario->endereco.'%20-%20'.$donatario->numerocasa.'" class="btn btn-lg btn-info">PEDIR DOAÇÃO</a>;' ?>
        </div>
    </div>
</div>
    
<div class="col-md-12 border mt-5">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-azul text-center display-4">HISTÓRICO DE DOAÇÕES RECEBIDAS</p>
        
        <?php
        
        
        
        if($donatario->historyDonate()){

            $list = $donatario->list;
            foreach($list as $history){
                ?>

                <div class="border mt-4">
                    <div class="ml-2 mt-2">
                        <p class="text-left" style="font-size: 20px;"><?php echo "Data da doação: $history[3] - Tipo: $history[2] - Detalhes da doação: $history[4]"; ?></p>
                    </div>
                </div>

                <?php
            }

        }else{
            ?>
            <div class="border p-5">
                <p class="text-center texto-vermelho" style="font-size: 22.5px;">Você ainda não recebeu nenhuma doação.</p>
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
}
?>
