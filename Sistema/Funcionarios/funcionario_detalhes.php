<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

// Verificar se o parâmetro "codigo" foi passado pela URL
if (isset($_GET['codigo'])) {
    $codigo_funcionario = $_GET['codigo'];

    // Consultar os dados do cliente no banco de dados
    $sql = "SELECT * FROM funcionarios WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o cliente foi encontrado
    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();

        // Consultar os dados do cliente no banco de dados
        $sql = "SELECT creci FROM corretores WHERE id_funcionario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $codigo_funcionario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0){
            $creci = $result->fetch_assoc();
        }
    }
    else{
        echo "Funcionário não encontrado.";
        exit();
    }
}
else{
    echo "Código do funcionário não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='#'>ImovelNet - FUNCIONÁRIOS</a>
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
        <h3 class="text-center mb-4">Detalhes do Funcionário</h3>
        <div class="mb-3">
            <label class="form-label">Nome Completo:</label>
            <p><?php echo $funcionario['nome']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Loja:</label>
            <p><?php echo $funcionario['id_loja']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">CPF:</label>
            <p><?php echo $funcionario['cpf']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">E-mail:</label>
            <p><?php echo $funcionario['email']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone:</label>
            <p><?php echo $funcionario['telefone']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Cargo:</label>
            <p><?php echo $funcionario['cargo']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Credi:</label>
            <p><?php echo ($creci['creci']) ? $creci['creci']: 'Não tem'; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Salário:</label>
            <p><?php echo $funcionario['salario']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Observação:</label>
            <p><?php echo $funcionario['obs']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <p><?php echo ($funcionario['status'] == '1') ? 'Ativo' : 'Inativo'; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Entrada:</label>
            <p><?php echo $funcionario['dt_entrada']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Saída:</label>
            <p><?php echo $funcionario['dt_saida']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Registro:</label>
            <p><?php echo $funcionario['dt_reg']; ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label">Última Alteração:</label>
            <p><?php echo $funcionario['dt_alt']; ?></p>
        </div>
        <a href="funcionario_editar.php?codigo=<?php echo $funcionario['id_funcionario']; ?>" class="btn btn-primary">Editar</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>