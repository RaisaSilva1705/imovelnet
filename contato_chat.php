<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "central/includes/menu_site_externo.php";

// Gerar dois números aleatórios para o CAPTCHA
$num1 = rand(1, 9);
$num2 = rand(1, 9);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária <?php echo $nome_site; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <?php echo $menu_nav; ?>

    <!-- Formulário de Contato -->
    <div class="container my-5 content">
        <h2 class="mb-4">Entre em Contato</h2>
        <form action="exec_contato.php" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="mb-3">
                <label for="mensagem" class="form-label">Mensagem</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
            </div>

            <!-- CAPTCHA -->
            <div class="mb-3">
                <label for="captcha" class="form-label">
                    Resolva a seguinte soma para provar que você não é um robô:
                    <?php echo "$num1 + $num2 = ?"; ?>
                </label>
                <input type="text" class="form-control" id="captcha" name="captcha" required>
            </div>

            <!-- Enviar os valores dos números do CAPTCHA -->
            <input type="hidden" name="num1" value="<?php echo $num1; ?>">
            <input type="hidden" name="num2" value="<?php echo $num2; ?>">

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white"><?php echo $info_rodape; ?></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

