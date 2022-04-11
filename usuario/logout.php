<?php

if(isset($_COOKIE['logadodoador']) && $_COOKIE['logadodoador'] == 'sim'){
    include_once '../class/Doador.php';

    $doador = new Doador();
    $doador->logout();
}else{
    if(isset($_COOKIE['logadodonatario']) && $_COOKIE['logadodonatario'] == 'sim'){
        include_once '../class/Donatario.php';

        $donatario = new Donatario();
        $donatario->logout();
    }
}

header("Location: index.php");

?>