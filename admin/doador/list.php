<?php

if(isset($_COOKIE['logadoadmin']) && $_COOKIE['logadoadmin'] == 'sim'){

    $search = '';

    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }
?>

<div class="col-md-12 border">
    <div class="col-md-12 p-5">
        <p class="fonte-impact font-weight-bold texto-azul text-center display-4">DOADORES</p>
        
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="frmbusca" enctype="multipart/form-data">
            <div class="d-flex justify-content-center align-items-center">
                <div class="form-group">
                    <input type="text" placeholder="Buscar..." class="form-control" name="buscar" id="buscar">
                </div>
                <p class="ml-3 mr-2">Buscar por:</p>
                <div class="form-group">
                <select class="form-control" name="buscarpor" id="buscarpor">
                    <option>Email</option>
                    <option>Nome</option>
                </select>
                </div>
                <div class="form-group ml-2">
                    <input type="submit" name="btnbuscar" class="btn btn-lg btn-success" value="Buscar">
                </div>
            </div>
        </form>

        <?php
        
        include_once '../class/Admin.php';
        include_once '../class/Doador.php';

        $doador = new Doador();

        if(isset($_POST['btnbuscar'])) {

            $buscar = filter_input(INPUT_POST, 'buscar', FILTER_SANITIZE_STRING);
            $buscarpor = filter_input(INPUT_POST, 'buscarpor', FILTER_SANITIZE_STRING);
    
            if($buscarpor == 'Email'){
                if($doador->searchByEmail($buscar)){
    
                    $list = $doador->list;
                    foreach($list as $search){
    
                        ?>
                        <div class="row border mt-4">
                            <div class="col-md-9 mt-2 mb-2 ml-2">
                                <span class="text-left" style="font-size: 20px;"><?php echo "Nome: $search[1] - Email: $search[3]" ?></span>
                            </div>
                            <div class="col-md-2 ml-5 d-flex justify-content-end align-items-center mt-2 mb-2">
                                <?php echo '<a class="text-center texto-azul" href="?p=doador/profile&id='.$search[0].'"><i class="material-icons align-middle">edit</i> Editar</a>' ?>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="border p-5">
                        <p class="text-center texto-vermelho" style="font-size: 22.5px;">Sem resultado para doadores.</p>
                    </div>
                    <?php
                }
            }else{
                if($doador->searchByName($buscar)){
                    $list = $doador->list;
                    foreach($list as $search){
    
                        ?>
                        <div class="row border mt-4">
                            <div class="col-md-9 mt-2 mb-2 ml-2">
                                <span class="text-left" style="font-size: 20px;"><?php echo "Nome: $search[1] - Email: $search[3]" ?></span>
                            </div>
                            <div class="col-md-2 ml-5 d-flex justify-content-end align-items-center mt-2 mb-2">
                                <?php echo '<a class="text-center texto-azul" href="?p=doador/profile&id='.$search[0].'"><i class="material-icons align-middle">edit</i> Editar</a>' ?>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <div class="border p-5">
                        <p class="text-center texto-vermelho" style="font-size: 22.5px;">Sem resultado para doadores.</p>
                    </div>
                    <?php   
                }
            }
        }else{
            if($doador->list()){
                $listreturn = $doador->list;
                foreach($listreturn as $list){

                    ?>
                    <div class="row border mt-4">
                        <div class="col-md-9 mt-2 mb-2 ml-2">
                            <span class="text-left" style="font-size: 20px;"><?php echo "Nome: $list[1] - Email: $list[3]" ?></span>
                        </div>
                        <div class="col-md-2 ml-5 d-flex justify-content-end align-items-center mt-2 mb-2">
                            <?php echo '<a class="text-center texto-azul" href="?p=doador/profile&id='.$list[0].'"><i class="material-icons align-middle">edit</i> Editar</a>' ?>
                        </div>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="border p-5">
                    <p class="text-center texto-vermelho" style="font-size: 22.5px;">Sem resultado para doadores.</p>
                </div>
                <?php   
            }
        }
        ?>
    </div>
</div>

<?php

}else{
    header("Location: index.php?p=login");
}
?>