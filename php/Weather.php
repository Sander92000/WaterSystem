<?php

class Weather{

    public $temp;
    public $hum;

    public function __construct(){
        
        include 'connect.php';

        $sql = "SELECT * FROM Weather ORDER BY Date DESC LIMIT 1";

        $query = mysqli_query($dbcon, $sql);
        $numRow = mysqli_num_rows($query);

        if ($numrow != 0){
            echo 'No data found...';
        } else {
            while ($row = mysqli_fetch_array($query)){
                $this->temp = $row['Air_temperature'];
                $this->hum = $row['Air_humidity'];
            }
        }
    }

    public function show(){
        echo '<div class="today">';
        echo '<h2>Conditions Today</h2>';
        echo '<div class="weather">';
        echo '<img src="../img/icons/thermometer.png" alt="temperature icon">';
        echo '<p>Temperature: <span id="temp">' . $this->temp . '°C</span></p>';
        echo '</div>';
        echo '<div class="weather">';
        echo '<img src="../img/icons/drop.png" alt="humidity icon">';
        echo '<p>Humidity: <span id="humidity">' . $this->hum . '%</span></p>';
        echo '</div>';
        echo '<div class="weather">';
        echo '<p>Light: <span id="light">1500 lum<span></p>';
        echo '</div>';
        echo '</div>';
    }

}