<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $username = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id_funcionario, email, senha, nome
                              FROM funcionarios
                              WHERE email = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        $passHash = $dados['senha'];

        if ($password == $passHash) {
            $_SESSION['id_funcionario'] = $dados['id_funcionario'];
            $_SESSION['nome'] = $dados['nome'];
            $_SESSION['expire'] = strtotime('+30 minutes', strtotime('now'));
            $_SESSION["msg"] = "<div class='alert alert-primary' role='aviso'>
                                    Olá <strong>".$_SESSION["nome"]."</strong>, Login Efetuado com sucesso!
                                </div>";
            mysqli_close($conn);                    
            header('Location: http://localhost/htdocs/imovelnet/Sistema/index2.php');
            exit();
        } else {
            $_SESSION["msg"] = "<div class='alert alert-danger' role='aviso'>
                                    Senha incorreta. Por favor, tente novamente.
                                </div>";
            mysqli_close($conn);
            header('Location: http://localhost/htdocs/imovelnet/Sistema/index.php');
            exit();
        }
    }
    else{
        $_SESSION["msg"] = "<div class='alert alert-warning' role='aviso'>
                                Usuário não encontrado. Por favor, verifique suas credenciais.
                            </div>";
        mysqli_close($conn);
        header('Location: http://localhost/htdocs/imovelnet/Sistema/index.php');
        exit();
    }
}
?>

