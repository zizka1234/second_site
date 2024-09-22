<?php
    $login = $_POST["login"];
    $pass = $_POST["password"];
    $host = "localhost";
    $db = "hoika";

    $conn = new mysqli($host, $login, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected";
    }

?>