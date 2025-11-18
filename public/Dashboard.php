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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a1a2f, #102b46);
            color: #fff;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            padding: 20px;
        }

        /* Botão voltar */
        .buttonVoltar {
            background: rgba(255, 255, 255, 0.12);
            border: none;
            padding: 10px;
            border-radius: 12px;
            cursor: pointer;
            backdrop-filter: blur(6px);
            transition: 0.3s;
        }

        .buttonVoltar img {
            width: 32px;
            filter: brightness(0) invert(1);
        }

        .buttonVoltar:hover {
            background: rgba(255, 210, 54, 0.25);
            transform: scale(1.06);
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .divCorpo {
            width: 95%;
            max-width: 480px;
            background: rgba(255, 255, 255, 0.08);
            padding: 35px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #fontAmarelo {
            color: #ffd236;
            font-size: 18px;
            margin-top: 20px;
        }

        .flex {
            display: flex;
            justify-content: center;
            margin: 15px 0;
        }

        #tremV {
            width: 180px;
            filter: drop-shadow(0 0 8px rgba(255, 210, 54, 0.4));
        }

        
        progress {
            width: 100%;
            height: 18px;
            border-radius: 10px;
            overflow: hidden;
            margin: 8px 0 3px 0;
            appearance: none;
        }

        progress::-webkit-progress-bar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        progress::-webkit-progress-value {
            background: linear-gradient(to right, #ffd236, #ffe372);
            border-radius: 10px;
        }

       
        #weather-info {
            margin-top: 10px;
            padding: 15px;
            background: rgba(255,255,255,0.12);
            border-radius: 12px;
        }

        #weather-info p {
            margin-bottom: 8px;
        }

        footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            opacity: 0.8;
        }

    </style>
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