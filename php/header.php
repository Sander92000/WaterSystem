<?php

    session_start();

    if(!isset($_SESSION['login_user'])){
        header('location: ../index.php');
    }

    $name = $_SESSION['login_user'];
    
    //session_begin();
    echo '<div class="header">';
        echo '<div class="header-title">';
            echo '<a href="home.php">Watersystem</a>';
        
            echo '<div class="header-right">';
                //Greet message
                echo '<p id="hello">Welcome ' . $name . '</p>';

                //Log out button
                echo '<img id="menu-btn" src="../img/icons/menu.png">';
            echo '</div>';
        echo '</div>';
    
    
        //Seperation
        echo '<div id="header-plant">';
        echo '</div>';
    echo '</div>';
?>
