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

        :root {
            background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);;
        }

        body{
            color: #FF0000;
            font-weight: 900;
            font-size: 1.5rem;
        }

        h1{
            text-align: center;
            text-transform: uppercase;

        }

    </style>
</head>

<body>

<h1>
    Consulta el Clima en Tu Ciudad
</h1>

<h2>
    Buscar el tiempo en la ciudad deseada
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

<?php if (isset($data) && $data['cod'] === 200): ?>
    <h2>Clima en <?= htmlspecialchars($city) ?></h2>
    <p>La temperatura es de <?= $data['main']['temp'] ?>°C con <?= $data['weather'][0]['description'] ?>.</p>
<?php elseif (isset($data['cod']) && $data['cod'] != 200): ?>
    <p>Error al obtener el clima: <?= htmlspecialchars($data['message']) ?>.</p>
<?php endif; ?>

</body>
</html>