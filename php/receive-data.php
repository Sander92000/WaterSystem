<?php

include 'connect.php';

$key = $_POST['api_key'];
var_dump($key);die;

if ($key != 'ABC123'){
    echo 'You are not authorized';
} else {
    $plant_id = $POST['plant_id'];
    $hum = $_POST['humidity'];

    $sql = 'INSERT INTO Logs (plant_id, humidity) VALUES (' . $plant_id . ',' . $hum . ')';

    $result = mysqli_query($dbcon, $sql);

    echo 'SUCCESS';
}

?>