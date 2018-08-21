<?php

session_start();
$error='';
if (isset($_POST['submit'])){
    if (empty($_POST['username'])||empty($_POST['password'])){
        $error = "Please fill in your username and your password";
    } else {
        $login_username = $_POST['username'];
        $login_password = $_POST['password'];

        //Get Connection
        include ('connect.php');

        //Protect from injection
        $login_username = stripcslashes($login_username);
        $login_password = stripslashes($login_password);
        $login_username = mysqli_real_escape_string($dbcon, $login_username);
        $login_password = mysqli_real_escape_string($dbcon, $login_password);

        //Query DB
        $sql = 'SELECT * FROM Users WHERE  Username = "' . $login_username . '" AND Password = "' . $login_password . '"';
        $query = mysqli_query($dbcon, $sql);
        $row = mysqli_num_rows($query);

        if($row == 1){
            $_SESSION['login_user'] = $login_username;
            header('location: home.php');
        } else {
            header('location: wrong.php');
        }
    }
}

?>