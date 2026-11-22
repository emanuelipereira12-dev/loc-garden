<?php
session_start();

$conn = new mysqli("localhost", "root", "", "locgarden");
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao  = $_POST['acao'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($acao === "cadastro") {
        $nome = trim($_POST['nome'] ?? '');
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $senhaHash);

        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso! Faça seu login.'); window.location.href = 'login.html';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar: e-mail já utilizado.'); window.location.href = 'login.html';</script>";
        }
        $stmt->close();

    } elseif ($acao === "login") {
        $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($user = $resultado->fetch_assoc()) {
            if (password_verify($senha, $user['senha'])) {
                $_SESSION['usuario_nome'] = $user['nome'];
                echo "<script>alert('Bem-vindo(a), " . addslashes($user['nome']) . "!'); window.location.href = 'inicio.html';</script>";
            } else {
                echo "<script>alert('Senha incorreta!'); window.location.href = 'login.html';</script>";
            }
        } else {
            echo "<script>alert('Usuário não encontrado!'); window.location.href = 'login.html';</script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>