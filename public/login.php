<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT id_usuario, nome, tipo FROM Usuario WHERE LOWER(nome) = LOWER(?) AND senha = MD5(?)");
    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nome'];
        $_SESSION['user_type'] = $user['tipo'];
        header("Location: menuInicial.php");
        exit();
    } else {
        $error = "Usuário ou senha inválidos.";
    }
    $stmt->close();
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Style.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <script src="../scripts/ValidarLogin.js"></script>
    <title>VAITREM</title>
</head>
<body>

    <header class="header_login">
        <div></div>
        <img class="foto" src="../assets/icons/iconeVaitrem.png" alt="icone da empresa">
        <h3>VAITREM</h3>
    </header>

    <main>
        <div class="login">
            <br>
            <h2 id="logincor">LOGIN</h2>

            <form id="loginFormulario" method="POST" action="login.php">

                <input type="text" id="usuario" name="usuario" required placeholder="Usuário">
                <div class="error" id="erroUsuario"></div>

                <br><br>

                <input type="password" id="senha" name="senha" required placeholder="Senha">
                <div class="error" id="erroSenha"><?php echo isset($error) ? $error : ''; ?></div>

                <br><br>

                <input type="checkbox" id="lembre">
                <label for="lembre" class="checkbox">Lembre de mim :</label>

                <br><br>

                <button type="submit">Entrar</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="direitos">
            <h4>© 2025 VAITREM. All rights reserved.</h4>
        </div>
    </footer>

</body>
</html>
