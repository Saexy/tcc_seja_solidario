<?php

include_once '../class/Admin.php';

$admin = new Admin();
$admin->logout();

header("Location: index.php");

?>