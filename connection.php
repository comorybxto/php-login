<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "database1";
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    if($conn->connect_error){
        die("<span style='color: grey;'>Connection failed: " . $conn->connect_error . "</span>");
    }
    echo "";
?>