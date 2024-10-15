<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

// Definir valores padrão para filtro e ordenação
$order_by = "id_funcionario";
$order_dir = "ASC";  // Ordem ascendente por padrão
$status_filter = ""; // Sem filtro de status por padrão

// Verificar se o usuário selecionou algum critério de ordenação ou filtro
if (isset($_GET['order_by'])) {
    $order_by = $_GET['order_by']; // Capturar o critério de ordenação
}

if (isset($_GET['order_dir']) && ($_GET['order_dir'] == 'ASC' || $_GET['order_dir'] == 'DESC')) {
    $order_dir = $_GET['order_dir']; // Capturar a direção da ordenação
}

if (isset($_GET['status'])) {
    $status_filter = $_GET['status']; // Capturar o filtro de status (ativo/inativo)
}

// Alternar entre ASC e DESC para o próximo clique
$next_order_dir = $order_dir == "ASC" ? "DESC" : "ASC";

// Construir a consulta SQL com base na ordenação e filtro, incluindo os dados da tabela 'corretores'
$sql = "SELECT f.*, c.creci, c.obs, c.status AS status_corretor 
        FROM funcionarios f
        LEFT JOIN corretores c ON f.id_funcionario = c.id_funcionario";

if ($status_filter !== "") {
    $sql .= " WHERE f.status = '$status_filter'";
}
$sql .= " ORDER BY $order_by $order_dir";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardex de Funcionarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='../../index.php'>ImovelNet - FUNCIONARIOS</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ms-auto'>
                    <li class='nav-item'><a class='nav-link active' href='funcionario_listagem.php'>Listar</a></li>                    
                    <li class='nav-item'><a class='nav-link' href='funcionario_cadastrar.php'>Cadastrar</a></li>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Voltar</a></li>
                    <li class='nav-item'><a class='nav-link' href="../../central/includes/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        // Verifica se $_SESSION["msg"] não é nulo e imprime a mensagem
        if(isset($_SESSION["msg"]) && $_SESSION["msg"] != null){
            echo $_SESSION["msg"];
            // Limpa a mensagem para evitar que seja exibida novamente
            $_SESSION["msg"] = null;
        }
    ?>

    <!-- Filtros e Ordenação -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Cardex de Funcionarios</h3>

        <!-- Tabela de Funcionarios -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">
                        <a class="col" href="?order_by=id_funcionario&order_dir=<?= $next_order_dir ?>">Código</a>
                    </th>
                    <th scope="col">
                        <a class="col" href="?order_by=nome&order_dir=<?= $next_order_dir ?>">Nome Completo</a>
                    </th>
                    <th scope="col">
                        <a class="col" href="?order_by=cargo&order_dir=<?= $next_order_dir ?>">Cargo</a>
                    </th>
                    <th scope="col">Creci</th>
                    <th scope="col">Documento</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["id_funcionario"] . '</td>';
                        echo '<td>' . $row["nome"] . '</td>';
                        echo '<td>' . $row["cargo"] . '</td>';
                        echo '<td>' . (!empty($row["creci"]) ? $row["creci"] : 'N/A') . '</td>';
                        echo '<td>' . $row["cpf"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["telefone"] . '</td>';
                        echo '<td>
                                <a href="funcionario_editar.php?codigo=' . $row["id_funcionario"] . '" class="btn btn-info btn-sm">Editar</a>
                                <a href="funcionario_detalhes.php?codigo=' . $row["id_funcionario"] . '" class="btn btn-warning btn-sm">Ver Detalhes</a>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="10" class="text-center">Nenhum funcionario encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white"><?php include "../../central/includes/menu_site_externo.php"; echo $info_rodape; ?></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
