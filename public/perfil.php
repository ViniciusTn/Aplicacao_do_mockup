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

    <!-- ================= CSS INTEGRADO ================= -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #0f2238);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        /* HEADER */
        .header_login {
            width: 100%;
            padding: 20px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
        }

        .header_login img {
            width: 55px;
            filter: drop-shadow(0 0 8px rgba(255, 210, 54, 0.5));
        }

        .header_login h3 {
            font-size: 26px;
            color: #ffd236;
            margin-top: 5px;
            letter-spacing: 2px;
        }

        /* CONTAINER DO PERFIL */
        .perfil-container {
            width: 90%;
            max-width: 450px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.07);
            padding: 30px;
            border-radius: 18px;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 0 20px rgba(255, 210, 54, 0.15);
            animation: fadeIn 0.4s ease-in-out;
        }

        .perfil-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffd236;
            font-size: 26px;
        }

        /* Mensagens */
        .success-message {
            background: rgba(0, 255, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* FORM */
        .perfil-form .form-group {
            margin-bottom: 18px;
        }

        .perfil-form label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            color: #ffd236;
        }

        .perfil-form input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            outline: none;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transition: 0.25s;
        }

        .perfil-form input:focus {
            background: rgba(255, 255, 255, 0.18);
            box-shadow: 0 0 10px rgba(255, 210, 54, 0.45);
        }

        .perfil-button {
            width: 100%;
            padding: 12px;
            background: #ffd236;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            color: #0a1a2f;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.25s;
        }

        .perfil-button:hover {
            background: #ffe372;
            box-shadow: 0 0 12px #ffd236;
        }

        /* ADMIN */
        .admin-section {
            margin-top: 20px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.09);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .admin-section p {
            margin-bottom: 8px;
        }

        .admin-link {
            color: #ffd236;
            font-weight: bold;
            text-decoration: none;
            transition: 0.3s;
        }

        .admin-link:hover {
            text-decoration: underline;
        }

        /* VOLTAR */
        .back-link {
            display: block;
            margin-top: 25px;
            text-align: center;
            text-decoration: none;
            color: #ffd236;
            font-weight: 700;
            transition: 0.25s;
        }

        .back-link:hover {
            text-shadow: 0 0 10px rgba(255, 210, 54, 0.6);
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 25px;
            opacity: 0.8;
            margin-top: auto;
        }

        footer h4 {
            font-weight: 400;
        }

        /* ANIMAÇÃO */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
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
