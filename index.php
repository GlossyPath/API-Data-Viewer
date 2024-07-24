<?php

if (isset($_GET['Ciudad']) && !empty($_GET['Ciudad'])) {
    $apiKey = "ebecefa8d9fbd75c2ff749772e1f82af";
    $city = htmlspecialchars($_GET['Ciudad']);

$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if($response === false) {
    $error = curl_error($ch);
    echo "cURL error: $error";
} else {
    // echo '<pre>' . htmlspecialchars($response) . '</pre>'; //para imprimir el json en la pagina
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
            margin:0;
            text-align: center;
            text-transform: uppercase;
            background-color: #508C9B;
            font-family: "Lemon";
            padding: 10px;
        }

        h2{
            padding-left: 10px;
        }

        h3{
            text-transform: uppercase;
            background-color:#508C9B;
            text-align: center;
            padding: 3px;
        }

        body{
            color: #201E43;
            font-weight: 900;
            display: flex;
            flex-direction: column;
            font-family: "Cheese";
        }

        .resultado p, .formulario {
            padding-left: 10px;
        }

        footer p{
            margin: 0;
            text-align: center;
            border-top: 3px solid #ddd;
            background-color: #508C9B;
            padding: 3px;
        }

    </style>
</head>


<body>

    <main>
        <h1>
            Consulta el Clima
        </h1>

        <h2>
            Introduce el nombre de la ciudad que quieres buscar
        </h2>

        <div class="formulario">
            <form action="index.php" method="get" >
                <p>Ciudad:
                    <input type="text" name="Ciudad" size="40" required>
                </p>
                <p>
                    <input type="submit" value="Enviar">
                    <input type = "reset" value="Borrar">
                </p>
            </form>
        </div>

        <div class="resultado">
            <?php if (isset($data) && $data['cod'] === 200): ?>
                <h3>Clima en <?= htmlspecialchars($city) ?> es de</h3>
                <p>La temperatura es de <?= $data['main']['temp'] ?>°C con <?= $data['weather'][0]['description'] ?>.</p>
                <p>La temperaura mínima es de <?= $data["main"]["temp_min"] ?>°C.</p>
                <p>La temperaura máxima es de <?= $data["main"]["temp_max"] ?>°C.</p>
                <p>La sensación térmica es de <?=$data["main"]["feels_like"] ?>°C.</p>
                <p>Velocidad del viento es de <?= $data["wind"]["speed"] ?> km/h. </p>
                <p>Porcentaje de humedad es de <?= $data["main"]["humidity"] ?> %.</p>
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