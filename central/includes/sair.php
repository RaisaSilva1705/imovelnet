<?php
    session_start();
    session_destroy();
    header('Location: http://localhost/htdocs/imovelnet/Sistema/index.php');
    exit;
?>