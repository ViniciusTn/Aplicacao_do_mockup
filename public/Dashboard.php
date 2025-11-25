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
    <link rel="icon" href="../assets/icons/iconeVaitrem.png" type="image/png">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../styles/Dashboard.css">
</head>

<body>

<header>
    <button onclick="window.location.href='menuInicial.php'" class="buttonVoltar" type="button">
        <img src="../assets/icons/botaoVoltar.png" alt="Voltar">
    </button>
</header>

<main>
    <div class="divCorpo">

        <p id="fontAmarelo"><strong>Último Trem Acessado</strong></p>

        <div class="flex">
            <img id="tremV" src="../assets/imgs/TremVcinza.png" alt="Trem">
        </div>

        <p id="fontAmarelo">Integridade dos trilhos</p>
        <progress max="100" value="<?php echo $integrity; ?>"></progress> 
        <?php echo $integrity; ?>%

        <p id="fontAmarelo">Quantidade de combustível</p>
        <progress max="100" value="<?php echo $quantity; ?>"></progress> 
        <?php echo $quantity; ?>%

        <p id="fontAmarelo"><strong>Funcionário responsável</strong></p>
        <p>Maquinista: Sr. Antenor</p>

        <p id="fontAmarelo"><strong>Previsão do Tempo</strong></p>
        <div id="weather-info">
            <p id="current-weather">Carregando...</p>
            <p id="forecast">Carregando...</p>
        </div>
    </div>
</main>

<footer>
    <h3>© 2025 VAITREM. All rights reserved.</h3>
</footer>



<script>
    async function fetchWeather() {
        const lat = -23.5505;
        const lon = -46.6333;
        const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code&hourly=temperature_2m&timezone=America/Sao_Paulo&forecast_days=1`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            let currentDesc = '';
            switch (data.current.weather_code) {
                case 0: currentDesc = 'Céu claro'; break;
                case 1: case 2: case 3: currentDesc = 'Parcialmente nublado'; break;
                case 45: case 48: currentDesc = 'Neblina'; break;
                case 51: case 53: case 55: currentDesc = 'Garoa'; break;
                case 61: case 63: case 65: currentDesc = 'Chuva'; break;
                case 71: case 73: case 75: currentDesc = 'Neve'; break;
                case 95: case 96: case 99: currentDesc = 'Tempestade'; break;
                default: currentDesc = 'Condições desconhecidas';
            }

            document.getElementById('current-weather').innerHTML =
                Atual: ${data.current.temperature_2m}°C - ${currentDesc};

            let forecastHtml = 'Previsão próximas 3 horas:<br>';
            for (let i = 1; i <= 3; i++) {
                const time = new Date(data.hourly.time[i]).toLocaleTimeString('pt-BR', { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
                forecastHtml += ${time}: ${data.hourly.temperature_2m[i]}°C<br>;
            }

            document.getElementById('forecast').innerHTML = forecastHtml;

        } catch (error) {
            document.getElementById('current-weather').innerHTML = 'Erro ao carregar tempo atual.';
            document.getElementById('forecast').innerHTML = 'Erro ao carregar previsão.';
        }
    }

    window.addEventListener('load', fetchWeather);
</script>

</body>
</html>