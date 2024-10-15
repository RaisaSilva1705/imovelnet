<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imobiliária ImovelNet</title>
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
                bottom: 0;
                width: 100%;
                background-color: #f8f9fa;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='#'>ImovelNet - PÁGINA DO FUNCIONÁRIO</a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ms-auto'>
                        <li class='nav-item'><a class='nav-link' href='./Clientes/index.php'>Clientes</a></li>                    
                        <li class='nav-item'><a class='nav-link' href='./Financeiro/index.php'>Financeiro</a></li>
                        <li class='nav-item'><a class='nav-link' href='./Funcionarios/index.php'>Funcionários</a></li>                    
                        <li class='nav-item'><a class='nav-link' href='./Imoveis/index.php'>Imóveis</a></li>
                        <li class='nav-item'><a class='nav-link active' href='../index.php'>Menu Principal</a></li>
                        <li class='nav-item'><a class='nav-link active' href="../central/includes/sair.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Banner -->
        <div class="container-fluid bg-dark text-white text-center p-5">
            <?php
                session_start();
                include "../central/includes/validar_sessao.php";
                // Verifica se $_SESSION["msg"] não é nulo e imprime a mensagem
                if(isset($_SESSION["msg"]) && $_SESSION["msg"] != null){
                    echo $_SESSION["msg"];
                    // Limpa a mensagem para evitar que seja exibida novamente
                    $_SESSION["msg"] = null;
                }
            ?>
            <h3>Index pagina CENTRAL</h3>
            <p>Menu do funcionário</p>     
        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        <!-- Footer -->
        <footer class="bg-light text-center text-lg-start">
            <div class="text-center p-3 bg-dark text-white">
                <p>© 2024 Imobiliária ImovelNet - Todos os direitos reservados.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>