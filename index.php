<?php

$apiKey = "ebecefa8d9fbd75c2ff749772e1f82af";

$city = "Valencia";

$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_close($ch); //cerramos curl

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        :root {
            background-color: #F6FB7A;
        }

        body{
            color: #73BBA3;
        }

    </style>
</head>

<body>

<h1>
    <?= $city ?>
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


</body>
</html>

