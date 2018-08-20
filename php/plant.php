<?php
class Plant{

    public $id;
    public $name;
    public $humidity;
    public $light;

    public function __construct($id, $name, $humLim, $lightLim){
        $this->id = $id;
        $this->name = $name;
        $this->humLim = $humLim;
        $this->lightLim = $lightLim;
    }

    public function show(){
        echo "<div class='plant'>";
        echo '<div class="plant-title">';
        echo '<h1>' . $this->name . '</h1>';
        //echo '<div class="plant-menu">';
        //echo '<a href="edit.php"><img src="../img/icons/edit.png" alt="edit"></a>';
        //echo '<a href="remove.php"><img src="../img/icons/delete.png" alt="delete"></a>';
        //echo '</div>';
        echo '</div>';
        echo '<div class="plant-details">';
        echo '<img src="../img/' . $this->name .'.jpg">';
        echo '<p>Last updated: ' . $this->getUpdate($this->id) .'</p>';
        echo '<p>Water level: ' . $this->getHumidityValue($this->id) . '%</p>';
        echo '<p>Water limit: ' . $this->humLim . '%</p>';
        echo '<p>Light limit: ' . $this->lightLim . 'Lum</p>';
        echo '</div>';
        echo '</div>';
    }

    public function getHumidityValue($id){
        require 'connect.php';

        $sql = "SELECT humidity FROM Logs WHERE plant_id = " . $id . " ORDER BY date DESC LIMIT 1";
        $query = mysqli_query($dbcon, $sql);
        $rowCheck = mysqli_num_rows($query);

        if ($rowCheck>0){
            while($row = mysqli_fetch_assoc($query)){
                $humidity = $row['humidity'];
            }
        } else {
            echo 'No data found...';
        }

        return $humidity;
    }

    public function getUpdate($id){
        require 'connect.php';

        $sql = "SELECT plant_id, date FROM Logs WHERE plant_id = " . $id . " ORDER BY date DESC LIMIT 1";
        $query = mysqli_query($dbcon, $sql);
        
        $rowCheck = mysqli_num_rows($query);
        if ($rowCheck>0){
            while($row = mysqli_fetch_assoc($query)){
                $date = $row['date'];
            }
        } else {
            echo 'No data found...';
        }
        return $date;
    }
}