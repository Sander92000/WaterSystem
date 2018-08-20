<!DOCTYPE HTML>

<html lang="EN">

<head>
    <meta charset="UTF-8">
    <title>New plant</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">

    <?php
        
        if(isset($_POST['add-plant'])){
            include 'connect.php';

            $name = $_POST['name'];
            $hum = $_POST['humidity'];
            $light = $_POST['light'];

            $sql = "INSERT INTO Plants (PlantName, Hum_Lim, Light_Lim) VALUES ('".$name."','".$hum."','".$light."');";

            $query = mysqli_query($dbcon, $sql);
            $rows = mysqli_count_rows($query);
        }
        
    ?>
</head>

<body>
    <div id="page">
        <?php
        include 'header.php';
        ?>
        <div class="container">
            <h1>Add a new plant</h1>
            <form id="new-plant" Method="POST" action="new.php">
                <div class="form-grp">
                    <label class="form-label" for="name">New plant name:</label>
                    <input class="form-input" type="text" name="name">
                </div>
                <br>
                <label for="humidity">New plant humidity level</label>
                <input class="input" type="range" id="humidity" name="humidity" min="0" max="100" value="0"><div id="value-humidity">0</div>
                <br>
                <label for="light">New plant light level</label>
                <input class="input" type="range" id="light" name="light" min="0" max="100" value="0"><div id="value-light">0</div>
                <br>
                <label for="more-info">Additional information<label>
                <input type="textarea" name="more-info">
                <br>
                <input id="btn-submit" type="submit" name="add-plant" value="Create new plant">
            </form>
        </div>

        <footer>
            <p>Webpage designed and developped by Sander Groot</p>
        </footer>
    </div>
    <?php
        include 'menu.php';
    ?>

    <script src="../js/main.js"></script>
    <script src="../js/new-plant.js"></script>
</body>

</html>