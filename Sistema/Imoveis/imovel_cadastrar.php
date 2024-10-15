<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir o arquivo de conexão
include '../../central/includes/conexao.php';
include "../../central/includes/validar_sessao.php";

$sql_cliente = "SELECT id_clientes, nome_completo FROM clientes";
$result_tipos = $conn->query($sql_cliente);
if ($result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $clientes[] = $row;
    }
}

$sql_loja = "SELECT id_loja, nome_loja FROM lojas";
$result_tipos = $conn->query($sql_loja);
if ($result_tipos->num_rows > 0) {
    while ($row = $result_tipos->fetch_assoc()) {
        $lojas[] = $row;
    }
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;
    $id_loja = $_POST['id_loja'] ?? null;
    $tipo_imovel = $_POST['tipo_imovel'] ?? null;
    $qtd_comodos = $_POST['qtd_comodos'] ?? null;
    $m2 = $_POST['m2'] ?? null;
    $qtd_fotos = $_POST['qtd_fotos'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $endereco = $_POST['endereco'] ?? null;
    $endereco_numero = $_POST['endereco_numero'] ?? null;
    $complemento = $_POST['complemento'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $obs = $_POST['obs'] ?? null;
    $status = $_POST['status'] ?? null;

    // Verificar se o CEP já existe na tabela 'ceps'
    $sql = "SELECT * FROM ceps WHERE endereco = ? AND bairro = ? AND cidade = ? AND estado = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $endereco, $bairro, $cidade, $estado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Caso o CEP não exista, inserir na tabela 'ceps'
        $sql_insert_cep = "INSERT INTO ceps (
            cep, endereco, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert_cep);

        $stmt_insert->bind_param("sssss", $cep, $endereco, $bairro, $cidade, $estado);
        $stmt_insert->execute();
    }

    // Atualizar os dados do imovel no banco de dados
    $sql = "INSERT INTO imoveis ( 
                id_cliente, id_loja, tipo_imovel, qtd_comodos, 
                m2, qtd_fotos, cep, endereco, endereco_numero,
                bairro, complemento, cidade, estado, obs,
                status, dt_reg, dt_alt)
            VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssss", 
        $id_cliente, $id_loja, $tipo_imovel, $qtd_comodos, 
        $m2, $qtd_fotos, $cep, $endereco, $endereco_numero, 
        $complemento, $bairro, $cidade, $estado, $obs, $status);

    session_start();
    if ($stmt->execute()) {
        $_SESSION["msg"] = "<div class='alert alert-primary' role='aviso'>
                                Imóvel cadastrado com sucesso!
                            </div>";
        header("Location: imovel_listagem.php"); // Redirecionar para a listagem de imoveis
        exit();
    } else {
        echo "Erro ao atualizar os dados: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='../../index.php'>ImovelNet</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav ms-auto'>
                    <li class='nav-item'><a class='nav-link' href='imovel_listagem.php'>Listar</a></li>                    
                    <li class='nav-item'><a class='nav-link active' href='imovel_cadastrar.php'>Cadastrar</a></li>
                    <li class='nav-item'><a class='nav-link' href='index.php'>Voltar</a></li>
                    <li class='nav-item'><a class='nav-link' href="../../central/includes/sair.php">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulário de Edição -->
    <div class="container my-5">
        <h3 class="text-center mb-4">Cadastrar Imóvel</h3>
        <form method="post" action="">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="id_cliente" class="form-label">Cliente</label><br>
                    <select name="id_cliente" id="id_cliente">
                        <option value="">Nenhum</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?php echo $cliente['id_clientes']; ?>"><?php echo $cliente['nome_completo']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="id_loja" class="form-label">Loja</label><br>
                    <select name="id_loja" id="id_loja">
                        <option value="">Nenhum</option>
                        <?php foreach ($lojas as $loja): ?>
                            <option value="<?php echo $loja['id_loja']; ?>"><?php echo $loja['nome_loja']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tipo_imovel" class="form-label">Tipo de Imóvel</label>
                    <select class="form-select" id="tipo_imovel" name="tipo_imovel" required>
                        <option value="CASA">Casa</option>
                        <option value="TERRENO">Terreno</option>
                        <option value="LOJA">Loja</option>
                        <option value="APTO">Apartamento</option>
                        <option value="COBERTURA">Cobertura</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="qtd_comodos" class="form-label">Quantidade de Cômodos</label>
                    <input type="text" class="form-control" id="qtd_comodos" name="qtd_comodos" required>
                </div>
                <div class="col-md-3">
                    <label for="m2" class="form-label">Metros Quadrados</label>
                    <input type="number" class="form-control" id="m2" name="m2" required>
                </div>
                <div class="col-md-3">
                    <label for="qtd_fotos" class="form-label">Quantidade de Fotos</label>
                    <input type="number" class="form-control" id="qtd_fotos" name="qtd_fotos" required>
                </div>
                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required>
                </div>
                <div class="col-md-2">
                    <label for="endereco_numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="endereco_numero" name="endereco_numero" required>
                </div>
                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" required>
                </div>

                <div class="col-md-2">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>

                <div class="col-md-2">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
                <div class="col-md-6">
                    <label for="obs" class="form-label">Observações</label>
                    <textarea class="form-control" id="obs" name="obs"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="imovel_listagem.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('cep').addEventListener('input', function() {
            let cep = this.value.trim();

            if (cep.length === 8) {  // Verifica se o CEP possui 8 dígitos
                fetch('busca_cep.php?cep=' + cep)
                    .then(response => response.text())
                    .then(text => {
                        console.log("Resposta recebida:", text);
                        const data = JSON.parse(text);
                        if (data.success) {
                            // Preencher os campos com os dados retornados
                            document.getElementById('endereco').value = data.endereco || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.cidade || '';
                            document.getElementById('estado').value = data.uf || '';
                            document.getElementById('complemento').value = data.complemento || '';
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Erro:', error));
            }
        });
    </script>
</body>
</html>
