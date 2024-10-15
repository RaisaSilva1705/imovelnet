<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "../../central/includes/validar_sessao.php";
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
        <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='#'>ImovelNet - IMÓVEIS</a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarNav'>
                    <ul class='navbar-nav ms-auto'>
                        <li class='nav-item'><a class='nav-link' href='imovel_listagem.php'>Listar</a></li>                    
                        <li class='nav-item'><a class='nav-link' href='imovel_cadastrar.php'>Cadastrar</a></li>
                        <li class='nav-item'><a class='nav-link active' href='../index2.php'>Menu Funcionário</a></li>
                        <li class='nav-item'><a class='nav-link active' href="../../central/includes/sair.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Banner -->
        <div class="container-fluid bg-secondary text-white text-center p-5">
            <h3>Gerenciamento de IMÓVEIS</h3>
        </div>

        <div class="container d-flex justify-content-center align-items-center content">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-10 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Listar</h5>
                            <p class="card-text">Lista de todos os imóveis.</p>
                            <a href="imovel_listagem.php" class="btn btn-light">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-10 mb-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Cadastrar</h5>
                            <p class="card-text">Cadastre novos imóveis.</p>
                            <a href="imovel_cadastrar.php" class="btn btn-light">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-light text-center text-lg-start">
            <div class="text-center p-3 bg-dark text-white">
                <p>© 2024 Imobiliária ImovelNet - Todos os direitos reservados.</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>