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

    // Consultar os dados do funcionário no banco de dados
    $sql = "SELECT * FROM funcionarios WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o funcionário foi encontrado
    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();
    } else {
        echo "Funcionário não encontrado.";
        exit();
    }

    // Consultar o creci do funcionario
    $sql = "SELECT creci FROM corretores WHERE id_funcionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o funcionário foi encontrado
    if ($result->num_rows > 0) {
        $creci = $result->fetch_assoc();
    }
} else {
    echo "Código do funcionário não fornecido.";
    exit();
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_completo'];
    $cargo = $_POST['cargo'];
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $salario = $_POST['salario'];
    $dt_entrada = $_POST['dataEntrada'];
    $dt_saida = !empty($_POST['dataSaida']) ? $_POST['dataSaida'] : null; // Verifica se o campo está vazio
    $obs = $_POST['obs'];

    // Verifica se $dt_saida é null para ajustar a query
    if ($dt_saida !== null) {
        $sql = "UPDATE funcionarios SET 
                    nome = ?, cpf = ?, email = ?, telefone = ?,
                    cargo = ?, salario = ?, dt_entrada = ?, dt_saida = ?,
                    obs = ?, dt_alt = NOW() 
                WHERE id_funcionario = ?";

        $stmt = $conn->prepare($sql);
        
        // Faz o bind com 10 variáveis (incluindo dt_saida)
        $stmt->bind_param("sssssdssss", 
            $nome, $cpf, $email, $telefone, $cargo, 
            $salario, $dt_entrada, $dt_saida, $obs, $codigo_funcionario);
    }
    else{
        // Se dt_saida for NULL, ajusta a query e ignora dt_saida
        $sql = "UPDATE funcionarios SET 
                    nome = ?, cpf = ?, email = ?, telefone = ?,
                    cargo = ?, salario = ?, dt_entrada = ?,
                    obs = ?, dt_alt = NOW() 
                WHERE id_funcionario = ?";

        $stmt = $conn->prepare($sql);
        
        // Faz o bind com 9 variáveis (sem dt_saida)
        $stmt->bind_param("sssssdsss", 
            $nome, $cpf, $email, $telefone, $cargo, 
            $salario, $dt_entrada, $obs, $codigo_funcionario);
    }

    var_dump($nome, $cpf, $email, $telefone, $cargo, $salario, $dt_entrada, $dt_saida, $obs);

    if ($stmt->execute()) {
        session_start();
        if ($stmt->affected_rows > 0) {
            $_SESSION["msg"] = "<div class='alert alert-primary' role='aviso'>
                                Dados atualizados com sucesso!
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
    <title>Editar Funcionário</title>
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
                    <li class='nav-item'><a class='nav-link active' href='funcionario_listagem.php'>Listar</a></li>                    
                    <li class='nav-item'><a class='nav-link' href='funcionario_cadastrar.php'>Cadastrar</a></li>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Voltar</a></li>
                    <li class='nav-item'><a class='nav-link' href="../../central/includes/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário de Edição -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Editar Funcionário</h3>
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome_completo" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" id="cargo" name="cargo" required>
                        <option value="Gerente" <?php if ($funcionario['cargo'] == 'Gerente') echo 'selected'; ?>>Gerente</option>
                        <option value="Vendedor" <?php if ($funcionario['cargo'] == 'Vendedor') echo 'selected'; ?>>Vendedor</option>
                        <option value="Assistente Administrativo" <?php if ($funcionario['cargo'] == 'Assistente Administrativo') echo 'selected'; ?>>Assistente Administrativo</option>
                        <option value="Financeiro" <?php if ($funcionario['cargo'] == 'Financeiro') echo 'selected'; ?>>Financeiro</option>
                        <option value="Coordenador de Vendas" <?php if ($funcionario['cargo'] == 'Coordenador de Vendas') echo 'selected'; ?>>Coordenador de Vendas</option>
                        <option value="Atendente" <?php if ($funcionario['cargo'] == 'Atendente') echo 'selected'; ?>>Atendente</option>
                        <option value="Marketing" <?php if ($funcionario['cargo'] == 'Marketing') echo 'selected'; ?>>Marketing</option>
                        <option value="Gerente de Loja" <?php if ($funcionario['cargo'] == 'Gerente de Loja') echo 'selected'; ?>>Gerente de Loja</option>
                        <option value="Consultor Imobiliário" <?php if ($funcionario['cargo'] == 'Consultor Imobiliário') echo 'selected'; ?>>Consultor Imobiliário</option>
                        <option value="Assistente de Vendas" <?php if ($funcionario['cargo'] == 'Assistente de Vendas') echo 'selected'; ?>>Assistente de Vendas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="creci" class="form-label">Creci</label>
                    <input type="text" class="form-control" id="creci" name="creci" value="<?php echo htmlspecialchars($creci['creci']); ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo htmlspecialchars($funcionario['cpf'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($funcionario['email']); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($funcionario['telefone']); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="salario" class="form-label">Salário</label>
                    <input type="text" class="form-control" id="salario" name="salario" value="<?php echo htmlspecialchars($funcionario['salario']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="obs" class="form-label">Observações</label>
                    <textarea class="form-control" id="obs" name="obs"><?php echo htmlspecialchars($funcionario['obs']); ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="dataEntrada" class="form-label">Data de Entrada</label>
                    <input type="text" class="form-control" id="dataEntrada" name="dataEntrada" value="<?php echo htmlspecialchars($funcionario['dt_entrada']); ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="dataSaida" class="form-label">Data de Saída</label>
                    <input type="text" class="form-control" id="dataSaida" name="dataSaida" value="<?php echo htmlspecialchars($funcionario['dt_saida'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="funcionario_listagem.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
