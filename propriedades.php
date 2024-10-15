<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include './central/includes/menu_site_externo.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária</title>
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
    <?php 
        echo $menu_nav;
    ?>

    <!-- Banner -->
    <div class="container-fluid bg-dark text-white text-center p-5">
        <h3>Busque uma Propriedade</h3>
    </div>

    <!-- Formulário de Busca -->
    <div class="container my-5 content">
        <form class="d-flex justify-content-center mb-4">
            <input class="form-control me-2" type="search" placeholder="Buscar propriedades" aria-label="Buscar">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>

        <!-- Listagem de Propriedades -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Casa 1">
                    <div class="card-body">
                        <h5 class="card-title">Casa Moderna</h5>
                        <p class="card-text">3 quartos, 2 banheiros, 1 garagem</p>
                        <a href="#" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Casa 2">
                    <div class="card-body">
                        <h5 class="card-title">Apartamento Luxuoso</h5>
                        <p class="card-text">2 quartos, 2 banheiros, varanda</p>
                        <a href="#" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Casa 3">
                    <div class="card-body">
                        <h5 class="card-title">Casa de Campo</h5>
                        <p class="card-text">4 quartos, 3 banheiros, piscina</p>
                        <a href="#" class="btn btn-primary">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white">© 2024 Imobiliária IFSP CJO</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
