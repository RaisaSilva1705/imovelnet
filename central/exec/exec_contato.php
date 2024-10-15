<?php
/*
Arquivo que processa formulario da pagina principal
*/
// Capturar os valores enviados
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Capturar os valores do CAPTCHA
$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$captcha = $_POST['captcha'];

// Verificar se a soma está correta
if ($captcha == ($num1 + $num2)) {
    // CAPTCHA correto, processar o formulário

    echo "<br><br><hr>Cliente, $nome enviou a seguinte mensagem:<br>";
    echo "Email: $email<br>";
    echo "Telefone: $telefone<br>";
    echo "Mensagem: $mensagem<br><br><hr>";

    echo "Mensagem enviada com sucesso!";
} else {
    // CAPTCHA incorreto, mostrar erro
    echo "Erro: A soma do CAPTCHA estava incorreta. Por favor, tente novamente.";
}
?>