<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$result = $conn->query("SELECT DISTINCT linha FROM Estacao ORDER BY linha ASC");
if (!$result) {
    die("Erro ao buscar linhas: " . $conn->error);
}

$linhas = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../styles/relatório.css">
    <script src="../scripts/ButtonValidators.js"></script>
</head>
<body>

    <div class="Botao">
        <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
        </button>
    </div>

    <main>
        <br>
        <h1 id="analises">Relatórios e Análises</h1>

        <?php foreach ($linhas as $linha): ?>
            <section class="secao">
                <div class="buttonsamarelo">
                    <a href="errolinha.php?linha=<?= $linha['linha'] ?>">
                        <button class="btn1">
                            <h1>Linha <?= $linha['linha'] ?></h1>
                        </button>
                    </a>
                </div>
            </section>
        <?php endforeach; ?>

    </main>

</body>
</html>