<?php
$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "locgarden";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome        = trim($_POST['nome'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $telefone    = trim($_POST['telefone'] ?? '');
    $equipamento = trim($_POST['equipamento'] ?? '');
    $mensagem    = trim($_POST['mensagem'] ?? '');

    $stmt = $conn->prepare("INSERT INTO agendamentos (nome, email, telefone, equipamento, mensagem) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $equipamento, $mensagem);

    if ($stmt->execute()) {
        echo "<script>
                alert('Agendamento enviado com sucesso! Em breve a equipe LocGarden entrará em contato.');
                window.location.href = 'inicio.html';
              </script>";
    } else {
        echo "Erro ao salvar os dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>