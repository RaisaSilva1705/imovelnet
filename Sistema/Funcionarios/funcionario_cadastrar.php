<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_completo'] ?? null;
    $cargo = $_POST['cargo'] ?? null;
    $cpf = $_POST['cpf'] ?? null; 
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $salario = $_POST['salario'] ?? null;
    $dt_entrada = $_POST['dataEntrada'] ?? null;
    $dt_saida = !empty($_POST['dataSaida']) ? $_POST['dataSaida'] : null; // Verifica se o campo está vazio
    $obs = $_POST['obs'] ?? null;

     // Verifica se $dt_saida é null para ajustar a query
     if ($dt_saida !== null) {
        $sql = "INSERT INTO funcionarios ( 
                    nome, cpf, email, telefone, cargo, salario, dt_entrada,
                    dt_saida, obs, dt_reg, dt_alt)
                VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = $conn->prepare($sql);
        
        // Faz o bind com 09 variáveis (incluindo dt_saida)
        $stmt->bind_param("sssssdsss", 
            $nome, $cpf, $email, $telefone, $cargo, 
            $salario, $dt_entrada, $dt_saida, $obs);
    }
    else{
        // Se dt_saida for NULL, ajusta a query e ignora dt_saida
        $sql = "INSERT INTO funcionarios ( 
            nome, cpf, email, telefone, cargo, salario,
            dt_entrada, obs, dt_reg, dt_alt)
        VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = $conn->prepare($sql);

        // Faz o bind com 08 variáveis (excluindo dt_saida)
        $stmt->bind_param("sssssdss", 
            $nome, $cpf, $email, $telefone, $cargo, 
            $salario, $dt_entrada, $obs);
    }

    var_dump($nome, $cpf, $email, $telefone, $cargo, $salario, $dt_entrada, $dt_saida, $obs);

    if ($stmt->execute()) {
        session_start();
        if ($stmt->affected_rows > 0) {
            $_SESSION["msg"] = "<div class='alert alert-primary' role='aviso'>
                                Funcionário cadastrado com sucesso!
                            </div>";
            header("Location: funcionario_listagem.php"); // Redirecionar para a listagem de funcionários
            exit();
        } else {
            echo "Nenhuma alteração feita nos dados.";
        }
    } else {
        echo "Erro ao atualizar os dados: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='#'>ImovelNet - CLIENTES</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ms-auto'>
                    <li class='nav-item'><a class='nav-link' href='funcionario_listagem.php'>Listar</a></li>                    
                    <li class='nav-item'><a class='nav-link active' href='funcionario_cadastrar.php'>Cadastrar</a></li>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Voltar</a></li>
                    <li class='nav-item'><a class='nav-link' href="../../central/includes/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário de Edição -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Cadastrar Funcionário</h3>
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
                </div>
                <div class="col-md-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" id="cargo" name="cargo" required>
                        <option value="Gerente">Gerente</option>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Assistente Administrativo">Assistente Administrativo</option>
                        <option value="Financeiro">Financeiro</option>
                        <option value="Coordenador de Vendas">Coordenador de Vendas</option>
                        <option value="Atendente">Atendente</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Gerente de Loja">Gerente de Loja</option>
                        <option value="Consultor Imobiliário">Consultor Imobiliário</option>
                        <option value="Assistente de Vendas">Assistente de Vendas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="salario" class="form-label">Salário</label>
                    <input type="text" class="form-control" id="salario" name="salario" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="col-md-6">
                    <label for="obs" class="form-label">Observações</label>
                    <textarea class="form-control" id="obs" name="obs"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="dataEntrada" class="form-label">Data de Entrada</label>
                    <input type="text" class="form-control" id="dataEntrada" name="dataEntrada" required>
                </div>
                <div class="col-md-3">
                    <label for="dataSaida" class="form-label">Data de Saída</label>
                    <input type="text" class="form-control" id="dataSaida" name="dataSaida">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
