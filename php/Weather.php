<?php

class Weather{

    public $temp;
    public $hum;

    public function __construct(){
        getWeather();
    }

    public function show(){
        echo '<div class="today">';
        echo '<h2>Conditions Today</h2>';
        echo '<p>Temperature: <span id="temp">' . $weather->temp . '°C</span></p>';
        echo '<p>Humidity: <span id="humidity">10%</span></p>';
        echo '<p>Light: <span id="light">1500 lum<span></p>';
        echo '</div>';
    }

    private function getWeather(){
        include 'connect.php';

        $sql = "SELECT * FROM weather ORDER BY Date DESC LIMIT 1";

        $query = mysqli_query($sql, $dbcon);
        $numRow = mysqli_rows_count($query);

        if ($numrow != 0){
            echo 'No data found...';
        } else {
            while ($row = mysqli_fetch_row($query)){
                $this->temp = $row['temperature'];
                $this->hum = $row['Air_humidity'];
            }
        }
    }

}