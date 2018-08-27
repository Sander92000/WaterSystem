<?php

    include 'connect.php';

$api_key = $_POST['api_key'];

if ($api_key != 'ABC123'){
    echo 'You ar not authorised to post data!';
} else {
    $temp = $_POST['temperature'];
    $hum = $POST['air_humidity'];

    $sql = 'INSERT INTO Weather (Temperature, Air_humidity) VALUES (' . $temp . ',' . $hum . ')';

    $query = mysqli_query($sql, $query);
    $numRows = mysqli_rows_count($query);

    if ($numRows=0){
        echo 'Could not add data';
    } else{
        echo 'Success';
    }



}