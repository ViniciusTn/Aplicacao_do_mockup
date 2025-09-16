<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

// Fetch trens
$result = $conn->query("SELECT * FROM Trem");
$trens = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/menu.css">
        <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
        <script src="../scripts/ValidarLogin.js"></script>
            <script src="../scripts/ButtonValidators.js"></script>

        <title>Carregamento</title>

    </head>
    <body>

        <header>
            <button onclick= "window.location.href='menuInicial.php'"  class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Ícone de botão" />
            </button>
        </header>


        <main>
            <div class="divCorpo">
                <?php foreach ($trens as $trem): ?>
                <div class="trem">
                    <div class="flex">
                        <img class="tremV" src="../assets/imgs/<?php echo $trem['id_trem']; ?>.png" alt="">
                        <h1>Trem   <?php echo $trem['codigo_trem']; ?><br><br>
                        -Sem adiversidades</h1>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </main>


        <footer>
            <br>
        <div class="direitos">
        <h3> © 2025 VAITREM. All rights reserved.</h3>
        </div>

        </footer>


    </body>
</html>
