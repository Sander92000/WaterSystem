<!DOCTYPE html>

<html lang="EN">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="css/text" href="../css/home.css">
</head>

<body>
    <?php
        include 'header.php';
    ?>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="new.php">Add new plant</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Plant name</h1>
        <form>
            <label>Plant name</label>
            <input type="text" name="plant-name">
            <label>Max humidity</label>
            <input type="text" name="plant-max-humidity">
            <label>Min humidity</label>
            <input type="text" name="plant-min-humidity">
            <input type="submit" value="save">
        </form>
        </form>
    </div>
</body>

</html>