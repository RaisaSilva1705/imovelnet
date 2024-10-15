<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SESSION['nome'] != null){
    $restaSessao = $_SESSION['expire'] - strtotime('now');
    echo $restaSessao . '<br>'; 
    echo $_SESSION['expire'] . '<br>';
    echo strtotime('now');


    if ($restaSessao < 1) {
        session_destroy();
        header('Location: http://localhost/htdocs/imovelnet/Sistema/index.php');
        exit;
    }  
}
else{
    header('Location: http://localhost/htdocs/imovelnet/Sistema/index.php');
    exit;
}
?>
