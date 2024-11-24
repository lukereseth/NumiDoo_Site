<?php
// Configuração do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$db_name = 'cadastro_db';

$conn = new mysqli($host, $usuario, $senha, $db_name);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        echo "Todos os campos são obrigatórios!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
    } elseif ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem!";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "O e-mail já está cadastrado!";
        } else {
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar. Tente novamente.";
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
  