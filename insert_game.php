<?php
    # проверка на подключение к базе +
    $localhost = "localhost";
    $user = "test_hoika_adm";
    $password = "";
    $database = "hoika";
    $conn = new mysqli($localhost,$user,$password,$database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # некоторые переменные
    $date = $_POST["date_1"];
    $modifi = $_POST["modifi"];
    $mod = $_POST["mod"];


    # добавление игры в базу
    $sql1 = "INSERT INTO games (date,modification,mode) VALUES ('$date','$modifi','$mod')";
    if ($conn->query($sql1) === TRUE) {
        echo "<script type='text/javascript'>window.close()</script>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
    $conn->close();
?>