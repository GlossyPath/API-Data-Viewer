<?php

$apiKey = "ebecefa8d9fbd75c2ff749772e1f82af";

$city = "Valencia";

$url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

$ch
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        :root {
            background-color: #B4E380;
        }

    </style>
</head>

<body>

<h1>
    <?= $city ?>
</h1>


</body>
</html>

