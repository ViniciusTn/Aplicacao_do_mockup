<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Perhaps redirect after loading
header("Refresh: 3; url=menuInicial.php");
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Style.css">
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <script src="../scripts/ValidarLogin.js"></script>
    <title>Carregamento</title>

</head>
<body>

    <header>
        <br>
        <div id="Navbar2">
        <img src="../assets/icons/iconeVaitrem.png" alt="icon da empresa" width="450">
        </div>
        <h1 id="titulocarregamento">VAITREM</h1>
    </header>

    <main>

        <div class="flex">
            <img id="loading-gif" src="../assets/icons/gifs/vecteezy-loading-circle-icon-l-unscreen.gif" alt="gif de girando">
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
