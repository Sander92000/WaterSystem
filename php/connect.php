<?php

//test

$debugMode = true;

if ($debugMode == true){
    //Test env
    $db_servername = 'localhost';
    $db_username = 'root';
    $db_password = 'root';
    $db_name = "Watersystem";
} else {
    //Prod env
    $db_servername = 'db747597085.db.1and1.com';
    $db_username = 'dbo747597085';
    $db_password = 'Formule1';
    $db_name = "db747597085";
}

$dbcon = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

if(!$dbcon){
    echo 'Connection failed';
}

?>