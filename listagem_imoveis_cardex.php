<?php
// Incluir o arquivo de conexão
include 'central/conexao.php';

// Consultar imóveis no banco de dados
$sql = "SELECT id_imovel, codigo, tipo_imovel, qtd_comodos, m2, cidade, estado, status FROM imoveis";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardex de Imóveis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <?php include "./central/includes/menu_site_externo.php"; ?>

    <!-- Cardex de Imóveis -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Cardex de Imóveis</h3>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Cômodos</th>
                    <th scope="col">Área (m²)</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["codigo"] . '</td>';
                        echo '<td>' . $row["tipo_imovel"] . '</td>';
                        echo '<td>' . $row["qtd_comodos"] . '</td>';
                        echo '<td>' . $row["m2"] . '</td>';
                        echo '<td>' . $row["cidade"] . '</td>';
                        echo '<td>' . $row["estado"] . '</td>';
                        echo '<td>' . ($row["status"] == '1' ? 'Ativo' : 'Inativo') . '</td>';
                        echo '<td>
                                <a href="detalhes_imovel.php?id=' . $row["id_imovel"] . '" class="btn btn-info btn-sm">Ver Detalhes</a>
                                <a href="editar_imovel.php?id=' . $row["id_imovel"] . '" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir_imovel.php?id=' . $row["id_imovel"] . '" class="btn btn-danger btn-sm">Excluir</a>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">Nenhum imóvel encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start">
        <div class="text-center p-3 bg-dark text-white"><?php echo $info_rodape; ?></div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
