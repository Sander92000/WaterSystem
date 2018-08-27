<!DOCTYPE HTML>

<html lang="EN">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet"> 
</head>

<body>
<div id="container">
    <div class="header">
    <h1>Watersystem</h1>
    </div>
    <form method="POST" action="php/login.php">
        <input type="text" class="input-field" name="username" placeholder="Username">
        <input type="password" class="input-field" name="password" placeholder="Password">
        <input type="submit" class="button" name="submit">
    </form>
</div>
</body>
</html>