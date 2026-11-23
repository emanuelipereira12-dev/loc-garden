<?php
session_start();

$ADMIN_USER = "admin";
$ADMIN_PASS = "locgarden123";

// Logout (Sair)
if (isset($_GET['sair'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

$erro_login = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['usuario_admin'])) {
    $user_digitado = trim($_POST['usuario_admin'] ?? '');
    $pass_digitada = $_POST['senha_admin'] ?? '';

    if ($user_digitado === $ADMIN_USER && $pass_digitada === $ADMIN_PASS) {
        $_SESSION['admin_logado'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $erro_login = "Usuário ou senha de administrador inválidos.";
    }
}

if (empty($_SESSION['admin_logado'])):
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo - LocGarden</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 340px; }
        h2 { color: #2e7d32; margin-top: 0; text-align: center; }
        label { display: block; margin-top: 12px; font-weight: bold; font-size: 14px; color: #333; }
        input { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #2e7d32; color: #fff; border: none; border-radius: 5px; font-weight: bold; margin-top: 20px; cursor: pointer; font-size: 15px; }
        button:hover { background: #1b5e20; }
        .erro { color: #c62828; background: #ffebee; padding: 8px; border-radius: 5px; font-size: 13px; text-align: center; margin-top: 10px; }
        .voltar { display: block; text-align: center; margin-top: 15px; color: #2e7d32; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Área Restrita - Admin</h2>
        <?php if ($erro_login): ?>
            <div class="erro"><?= htmlspecialchars($erro_login) ?></div>
        <?php endif; ?>
        <form method="POST" action="admin.php">
            <label for="usuario_admin">Usuário</label>
            <input type="text" id="usuario_admin" name="usuario_admin" required placeholder="Digite o usuário">

            <label for="senha_admin">Senha</label>
            <input type="password" id="senha_admin" name="senha_admin" required placeholder="Digite a senha">

            <button type="submit">Entrar no Painel</button>
        </form>
        <a href="inicio.html" class="voltar">← Voltar para o site</a>
    </div>
</body>
</html>
<?php
    exit;
endif;

$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "locgarden";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$sql = "SELECT * FROM agendamentos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo - LocGarden</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f5; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 1000px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .topo { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #2e7d32; padding-bottom: 10px; }
        h1 { color: #2e7d32; margin: 0; font-size: 22px; }
        .acoes { display: flex; gap: 10px; }
        .btn-voltar { text-decoration: none; background: #2e7d32; color: #fff; padding: 8px 14px; border-radius: 5px; font-weight: bold; font-size: 14px; }
        .btn-sair { text-decoration: none; background: #c62828; color: #fff; padding: 8px 14px; border-radius: 5px; font-weight: bold; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; font-size: 14px; }
        th { background-color: #2e7d32; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .vazio { text-align: center; padding: 20px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topo">
            <h1>Painel Administrativo - Solicitações de Locação</h1>
            <div class="acoes">
                <a href="inicio.html" class="btn-voltar">← Site</a>
                <a href="admin.php?sair=1" class="btn-sair">Sair</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Equipamento</th>
                    <th>Mensagem</th>
                    <th>Data/Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while($linha = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($linha['id']) ?></td>
                            <td><?= htmlspecialchars($linha['nome']) ?></td>
                            <td><?= htmlspecialchars($linha['email']) ?></td>
                            <td><?= htmlspecialchars($linha['telefone']) ?></td>
                            <td><?= htmlspecialchars($linha['equipamento']) ?></td>
                            <td><?= htmlspecialchars($linha['mensagem']) ?></td>
                            <td><?= isset($linha['data_envio']) ? date('d/m/Y H:i', strtotime($linha['data_envio'])) : '-' ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="vazio">Nenhum agendamento registrado até o momento.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>