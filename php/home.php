<!DOCTYPE HTML>

<html lang="EN">

<head>
    <meta charset="UTF-8">
    <title>Watersytem</title>
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet"> 
</head>

<body>
    <div id="page">
        <?php
        include 'header.php';
        ?>
        <div class="container">
            <div class="content">
                <?php
                    include 'Weather.php';
                    
                    $weather = new Weather();
                    
                    $weather->show();
                ?>

                <?php
                    // Outside files
                    include 'plant.php';
                    include 'connect.php';
                    
                    // Variables
                    $plants = array();
                    $id = array();
                    $name = array();
                    $humidity = array();
                    $light = array();

                    // Get number of plants in DB
                    $sql = "SELECT * FROM Plants";
                    $result = mysqli_query($dbcon, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            array_push($id, $row['plant_id']);
                            array_push($name, $row['plant_name']);
                            array_push($humidity, $row['hum_lim']);
                            array_push($light, $row['light_lim']);
                        }
                    } else {
                        echo 'No data found';
                    }

                    for ($i=0; $i<=$resultCheck - 1; $i++){
                        $plants[$i] = new Plant($id[$i], $name[$i], $humidity[$i], $light[$i]);
                        $plants[$i]->show();
                    }
                ?>
            </div>
        </div>
        <?php
            include 'footer.php';
        ?>
    </div>
    <?php
        include 'menu.php';
    ?>
    <script src="../js/main.js"></script>
</body>

</html>
