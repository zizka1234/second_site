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
    $name = $_POST['name'];

    # добавление игры в базу
    $sql1 = "INSERT INTO players (name) VALUES ('$name')";
    if ($conn->query($sql1) === TRUE) {
        echo "<script type='text/javascript'>window.close()</script>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
    $conn->close();
?>