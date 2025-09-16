<?php
session_start();
include '../db.php';

if (!isset($_SESSION['cadastro'])) {
    header("Location: cadastro.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha_confirm = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $cad = $_SESSION['cadastro'];

    if ($senha_confirm !== $cad['senha']) {
        $error = "Senhas não coincidem.";
    } elseif (empty($nome) || empty($telefone) || empty($cpf)) {
        $error = "Por favor, preencha todos os campos.";
    } else {
        // Hash the password
        $senha_hash = password_hash($cad['senha'], PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO Usuario (nome, email, senha, telefone, cpf) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nome, $cad['email'], $senha_hash, $telefone, $cpf);

        if ($stmt->execute()) {
            unset($_SESSION['cadastro']);
            header("Location: GestaoDeRotas.php");
            exit();
        } else {
            $error = "Erro ao cadastrar: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
  <link rel="stylesheet" href="../styles/cadastro2.css">
    <script src="../scripts/cadastro.js"></script>

  <title>Cadastro</title>
</head>
<body>

  <div class="topo">
    <img src="../assets/icons/iconeVaitrem.png" alt="Logo">
    <p>VaiTrem</p>
  </div>

  <main class="tela-principal">
    <div class="cadastro-box">
      <div class="cadastro-title">Cadastro</div>

      <?php if (isset($error)) { echo '<p style="color:red;">' . $error . '</p>'; } ?>

      <form method="POST" action="cadastro2.php">
        <div class="form-group">
          <input type="text" name="nome" placeholder="Nome completo" required />
        </div>

        <div class="form-group">
          <input type="password" name="senha" placeholder="Senha" required />
        </div>

        <div class="form-group">
          <input type="text" name="telefone" placeholder="Telefone" required />
        </div>

        <div class="form-group">
          <input type="text" name="cpf" placeholder="CPF" required />
        </div>

        <div class="center">
          <a href="GestaoDeRotas.php"><button class="btn-proximo">Cadastrar</button></a>
        </div>
      </form>
    </div>
  </main>

</body>
</html>
