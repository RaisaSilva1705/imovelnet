<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

// Verificar se o parâmetro "codigo" foi passado pela URL
if (isset($_GET['codigo'])) {
    $codigo_cliente = $_GET['codigo'];

    // Consultar os dados do cliente no banco de dados
    $sql = "SELECT * FROM clientes WHERE id_clientes = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o cliente foi encontrado
    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    }
    else{
        echo "Cliente não encontrado.";
        exit();
    }
}
else{
    echo "Código do cliente não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='#'>ImovelNet - CLIENTES</a>
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
        <h3 class="text-center mb-4">Detalhes do Cliente</h3>
        <div class="mb-3">
            <label class="form-label">Nome Completo:</label>
            <p><?php echo $cliente['nome_completo']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de Pessoa:</label>
            <p><?php echo $cliente['tipo_pessoa']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Documento:</label>
            <p><?php echo $cliente['documento']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">E-mail:</label>
            <p><?php echo $cliente['email']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone:</label>
            <p><?php echo $cliente['telefone']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">CEP:</label>
            <p><?php echo $cliente['cep']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço:</label>
            <p><?php echo $cliente['endereco']; ?>, Nº <?php echo $cliente['endereco_numero']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Complemento:</label>
            <p><?php echo $cliente['complemento']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Bairro:</label>
            <p><?php echo $cliente['bairro']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade:</label>
            <p><?php echo $cliente['cidade']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Estado:</label>
            <p><?php echo $cliente['estado']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <p><?php echo ($cliente['status'] == '1') ? 'Ativo' : 'Inativo'; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Registro:</label>
            <p><?php echo $cliente['dt_reg']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Última Alteração:</label>
            <p><?php echo $cliente['dt_alt']; ?></p>
        </div>
        <a href="cliente_alterar.php?codigo=<?php echo $cliente['id_clientes']; ?>" class="btn btn-primary">Editar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>