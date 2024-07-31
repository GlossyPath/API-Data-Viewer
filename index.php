<?php

if (isset($_GET['city']) && !empty($_GET['city'])) {
    $apiKey = "ebecefa8d9fbd75c2ff749772e1f82af";
    $city = htmlspecialchars($_GET['city']);

$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if($response === false) {
    $error = curl_error($ch);
    echo "cURL error: $error";

} else {
    $data = json_decode($response, true);
}

curl_close($ch);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        @font-face{
            font-family: "Lemon";
            src: url(tipografia/Scratchy\ Lemon.ttf);
        }

        @font-face{
            font-family: "Cheese";
            src: url(tipografia/Keep\ Cheese.ttf)
        }

        @-webkit-keyframes vignette-anim {
            0%   , 100%{ opacity: 2; }
            50% { opacity: 0.7; }
        }

        @-moz-keyframes vignette-anim {
            0%   , 100%{ opacity: 2; }
            50% { opacity: 0.7; }
        }

        @-o-keyframes vignette-anim {
            0%   , 100%{ opacity: 2; }
            50% { opacity: 0.7; }
        }

        @keyframes vignette-anim {
            0%   , 100%{ opacity: 2; }
            50% { opacity: 0.7; }
        }

        :root {
            background-color: #EEEEEE;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-size: 1.5rem;
        }

        main{
            flex:1;
        }

        h1{
            background: linear-gradient(to right, #B6FFFA 0%, #B6FFFA 32%, #B6FFFA 100%);
            font-size: 4rem;
            margin:0;
            text-align: center;
            text-transform: uppercase;
            background-color: #508C9B;
            font-family: "Lemon";
            padding: 10px;
            text-shadow: 5px 5px 7px #201E43;
            color:#80B3FF;
        }

        h2{
            padding-left: 10px;
            text-transform: uppercase;
        }

        h3{
            text-transform: uppercase;
            background: linear-gradient(to right, #B6FFFA 0%, #B6FFFA 32%, #B6FFFA 100%);
            text-align: center;
            font-family: "Lemon";
            padding: 10px;
            color:#80B3FF;
            text-shadow: 5px 5px 7px #201E43;
            font-size: 3rem;
            margin:0 80px 0 80px;
            border-radius:10px;
        }

        body{
            color: #687EFF;
            font-weight: 900;
            display: flex;
            flex-direction: column;
            font-family: "Cheese";
            text-transform: uppercase;
        }

        .resultado li, .formulario {
            margin: 0;
            padding-left: 10px;
        }

        .resultado {
            margin:0;
        }

        footer p{
            margin: 0;
            text-align: center;
            border-top: 3px solid #ddd;
            background: linear-gradient(to right, #B6FFFA 0%, #B6FFFA 32%, #B6FFFA 100%);
            padding: 3px;
            color: #687EFF;
        }

        .pagCompleta{
            position: absolute;
            width: 100%;
            height: 100%;
            box-shadow: inset 0px 0px 150px 20px #80B3FF;
            mix-blend-mode: multiply;
            -webkit-animation: vignette-anim 3s infinite;
            -moz-animation: vignette-anim 3s infinite;
            -o-animation: vignette-anim 3s infinite;
            animation: vignette-anim 3s infinite;
            z-index: -1;
        }



    </style>
</head>


<body>

    <main>
    <div class="pagCompleta"></div>

        <h1>
            Consulta el Clima
        </h1>

        <h2>
            Introduce el nombre de la ciudad que quieres buscar
        </h2>

        <div class="formulario">
            <form action="index.php" method="get" >
                <p>Ciudad:
                    <input type="text" name="city" size="40" required>
                </p>
                <p>
                    <input type="submit" value="Enviar">
                    <input type = "reset" value="Borrar">
                </p>
            </form>
        </div>

        <div class="resultado">
            <?php if (isset($data) && $data['cod'] === 200): ?>
                <h3><?= htmlspecialchars($city) ?></h3>
                <ul>
                    <li>La temperatura es de <?= $data['main']['temp'] ?>°C con <?= $data['weather'][0]['description'] ?>.</li>
                    <li>La temperaura mínima es de <?= $data["main"]["temp_min"] ?>°C.</li>
                    <li>La temperaura máxima es de <?= $data["main"]["temp_max"] ?>°C.</li>
                    <li>La sensación térmica es de <?=$data["main"]["feels_like"] ?>°C.</li>
                    <li>Velocidad del viento es de <?= $data["wind"]["speed"] ?> km/h. </li>
                    <li>Porcentaje de humedad es de <?= $data["main"]["humidity"] ?> %.</li>
                </ul>
            <?php elseif (isset($data['cod']) && $data['cod'] != 200): ?>
                <p>Error al obtener el clima: <?= htmlspecialchars($data['message']) ?>.</p>
            <?php endif; ?>
        </div>
    </main>

<footer>
    <p>
        Desarrollado por GlossyPath
    </p>
</footer>

</body>
</html>