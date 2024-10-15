<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

// Verificar se o parâmetro "codigo" foi passado pela URL
if (isset($_GET['imovel'])) {
    $codigo_imovel = $_GET['imovel'];

    // Consultar os dados do cliente no banco de dados
    $sql = "SELECT * FROM imoveis WHERE id_imovel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_imovel);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o cliente foi encontrado
    if ($result->num_rows > 0) {
        $imovel = $result->fetch_assoc();
    }
    else{
        echo "Imóvel não encontrado.";
        exit();
    }
}
else{
    echo "Código do imóvel não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li class='nav-item'><a class='nav-link active' href='cliente_listagem.php'>Listar</a></li>                    
                    <li class='nav-item'><a class='nav-link' href='cliente_cadastrar.php'>Cadastrar</a></li>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Voltar</a></li>
                    <li class='nav-item'><a class='nav-link' href="../../central/includes/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h3 class="text-center mb-4">Detalhes do Imóvel</h3>
        <div class="mb-3">
            <label class="form-label">Tipo do Imóvel:</label>
            <p><?php echo $imovel['tipo_imovel']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Loja:</label>
            <p><?php echo $imovel['id_loja']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Cliente:</label>
            <p><?php echo $imovel['id_cliente']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantidade de Cômodos:</label>
            <p><?php echo $imovel['qtd_comodos']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Área(m²):</label>
            <p><?php echo $imovel['m2']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantidade de Fotos:</label>
            <p><?php echo $imovel['qtd_fotos']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP:</label>
            <p><?php echo $imovel['cep']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço:</label>
            <p><?php echo $imovel['endereco']; ?>, Nº <?php echo $imovel['endereco_numero']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Complemento:</label>
            <p><?php echo $imovel['complemento']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro:</label>
            <p><?php echo $imovel['bairro']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade:</label>
            <p><?php echo $imovel['cidade']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <p><?php echo $imovel['estado']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Observação:</label>
            <p><?php echo $imovel['obs']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <p><?php echo ($imovel['status'] == '1') ? 'Ativo' : 'Inativo'; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Registro:</label>
            <p><?php echo $imovel['dt_reg']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Última Alteração:</label>
            <p><?php echo $imovel['dt_alt']; ?></p>
        </div>
        <a href="imovel_editar.php?codigo=<?php echo $imovel['id_imovel']; ?>" class="btn btn-primary">Editar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>