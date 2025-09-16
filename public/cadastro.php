<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Basic validation (you can expand this)
    if (empty($dia) || empty($mes) || empty($ano) || empty($usuario) || empty($email) || empty($senha)) {
        $error = "Por favor, preencha todos os campos.";
    } else {
        // Store in session for second step
        $_SESSION['cadastro'] = [
            'dia' => $dia,
            'mes' => $mes,
            'ano' => $ano,
            'usuario' => $usuario,
            'email' => $email,
            'senha' => $senha
        ];
        header("Location: cadastro2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
  <link rel="stylesheet" href="../styles/cadastro.css">
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

      <form method="POST" action="cadastro.php">
        <div class="data-inputs">
          <div class="form-group">
            <label for="dia">Dia</label>
            <input type="text" id="dia" name="dia" placeholder="DD" required />
          </div>
          <div class="form-group">
            <label for="mes">Mês</label>
            <input type="text" id="mes" name="mes" placeholder="MM" required />
          </div>
          <div class="form-group">
            <label for="ano">Ano</label>
            <input type="text" id="ano" name="ano" placeholder="AAAA" required />
          </div>
        </div>

        <div class="form-group">
          <input type="text" id="usuario" name="usuario" placeholder="Usuário" required />
        </div>

        <div class="form-group">
          <input type="email" id="email" name="email" placeholder="Email" required />
        </div>

        <div class="form-group">
          <input type="password" id="senha" name="senha" placeholder="Senha" required />
        </div>

        <div class="center">
          <button class="btn-proximo" type="submit">Próximo</button>
        </div>
      </form>
    </div>
  </main>

  <script src="../scripts/cadastro.js"></script>
</body>
</html>
