<?php
/* 
Função para gerar códigos 
para Clientes: QW3D5F-3DGH12
exemplo: echo gerarCodigoCliente();
*/

function gerarCodigoCliente() {
    $caracteres = 'QWERTYUPADFGHJKLZXCVM1234567890';
    
    $parte1 = substr(str_shuffle($caracteres), 0, 6);
    $parte2 = substr(str_shuffle($caracteres), 0, 6);
    
    return $parte1 . '-' . $parte2;
}

/* 
Função para gerar códigos 
para Imóveis: QWERT-321-Q13B5FG
exemplo: echo gerarCodigoImovel();
*/

function gerarCodigoImovel() {
    $caracteres = 'QWERTYUPADFGHJKLZXCVM1234567890';
    
    $parte1 = substr(str_shuffle($caracteres), 0, 5);
    $parte2 = substr(str_shuffle($caracteres), 0, 3);
    $parte3 = substr(str_shuffle($caracteres), 0, 7);
    
    return $parte1 . '-' . $parte2 . '-' . $parte3;
}


/* 
Função para gerar códigos 
para Funcionários: QWERT-321-Q13B5FG
exemplo: echo gerarCodigoFuncionario();
*/

function gerarCodigoFuncionario() {
    $caracteres = 'QWERTYUPADFGHJKLZXCVM1234567890';
    
    $codigo = substr(str_shuffle($caracteres), 0, 7);
    
    return $codigo;
}

// Exemplo de uso
//echo gerarCodigoFuncionario();


?>