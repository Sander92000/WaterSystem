<?php

include 'connect.php';

$key = $_GET['api_key'];

if ($key != 'ABC123'){
    echo 'You are not authorized';
} else {
    $plant_id = $_GET['plant_id'];
    $hum = $_GET['humidity'];

    $sql = 'INSERT INTO Logs (plant_id, humidity) VALUES (' . $plant_id . ',' . $hum . ')';

    $result = mysqli_query($dbcon, $sql);
    
    echo 'SUCCESS';
}

?>