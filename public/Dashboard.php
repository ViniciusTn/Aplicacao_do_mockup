<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../db.php';

$result = $conn->query("SELECT * FROM Trem ORDER BY id_trem ASC LIMIT 1");
$trem = $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;

$integrity = $trem ? 85 : 100; 
$quantity = 70;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/menu.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar" type="button">
            <img src="../assets/icons/botaoVoltar.png" alt="Voltar" />
        </button>
    </header>
    <main>
        <div class="divCorpo">
            <p id="fontAmarelo"><strong>Último Trem Acessado</strong></p>
            <div class="flex">
                <img id="tremV" src="../assets/imgs/TremVcinza.png" alt="Trem" />
            </div>

            <p id="fontAmarelo">Integridade dos trilhos</p>
            <progress max="100" value="<?php echo $integrity; ?>"></progress> <?php echo $integrity; ?>%

            <p id="fontAmarelo">Quantidade de combustível</p>
            <progress max="100" value="<?php echo $quantity; ?>"></progress> <?php echo $quantity; ?>%

            <p id="fontAmarelo"><strong>Funcionário responsável</strong></p>
            <p>Maquinista: Sr. Antenor</p>
        </div>
    </main>
    <footer>
        <div class="direitos">
            <h3>© 2025 VAITREM. All rights reserved.</h3>
        </div>
    </footer>
</body>
</html>
