<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Fetch user data
$stmt = $conn->prepare("SELECT nome, email FROM Usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];

    // Verify current password
    $stmt = $conn->prepare("SELECT senha FROM Usuario WHERE id_usuario = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_hash = $result->fetch_assoc()['senha'];
    $stmt->close();

    if (md5($senha_atual) === $current_hash) {
        // Update name and email
        $stmt = $conn->prepare("UPDATE Usuario SET nome = ?, email = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssi", $nome, $email, $user_id);
        $stmt->execute();
        $stmt->close();

        // Update password if provided
        if (!empty($nova_senha)) {
            $nova_hash = md5($nova_senha);
            $stmt = $conn->prepare("UPDATE Usuario SET senha = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $nova_hash, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        $_SESSION['user_name'] = $nome;
        $success = "Perfil atualizado com sucesso!";
    } else {
        $error = "Senha atual incorreta.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - VAITREM</title>
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">

    <link rel="stylesheet" href="../styles/perfil.css">
</head>

<body>

<header class="header_login">
    <img src="../assets/icons/iconeVaitrem.png" alt="icone da empresa">
    <h3>VAITREM</h3>
</header>

<main>
    <div class="perfil-container">
        <h2>Perfil do Usuário</h2>

        <?php if (isset($success)): ?>
            <p class="success-message"><?= $success ?></p>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="perfil.php" class="perfil-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="senha_atual">Senha Atual:</label>
                <input type="password" id="senha_atual" name="senha_atual" required>
            </div>

            <div class="form-group">
                <label for="nova_senha">Nova Senha (opcional):</label>
                <input type="password" id="nova_senha" name="nova_senha">
            </div>

            <button type="submit" class="perfil-button">Atualizar Perfil</button>
        </form>

        <?php if ($user_type === 'admin'): ?>
            <div class="admin-section">
                <p>Como administrador, você pode gerenciar usuários.</p>
                <a href="../private/addUsuario.php" class="admin-link">Adicionar Usuário</a>
            </div>
        <?php endif; ?>

        <a href="menuInicial.php" class="back-link">Voltar ao Menu</a>
    </div>
</main>

<footer>
    <div class="direitos">
        <h4>© 2025 VAITREM. All rights reserved.</h4>
    </div>
</footer>

</body>
</html>
