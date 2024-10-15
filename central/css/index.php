<?php
/* 
Criado por Ricardo Alsoa 
01/Abr/2021
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../funcoes/links_internos.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Redirecionando</title>
<meta http-equiv="refresh" content=1;url="<? echo $redireciona; ?>">
</head>
<body>
</body>
</html>