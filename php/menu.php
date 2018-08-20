<?php
    echo '<div id="menu" class="menu">';
        //Menu header
        echo '<div id="menu-title">';
            echo '<h2>Menu</h2>';
        echo '</div>';
        //Menu
        echo '<div class="menu-link">';
            echo '<div class="menu-icon">';
                echo '<img src="../img/icons/add.png">';
            echo '</div>';
            echo '<div class="menu-label">';
                echo '<a href="new.php">Add new plant</a>';
            echo '</div>';
        echo '</div>';
        echo '<div class="menu-link">';
            echo '<div class="menu-icon">';
                echo '<img src="../img/icons/power.png">';
            echo '</div>';
            echo '<div class="menu-label">';
                echo '<a href="logout.php">Log out</a>';
            echo '</div>';
        echo '</div>';
?>