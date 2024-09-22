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

    $name = $_POST["name"];
    $game = $_POST["game"];
    $alliance = $_POST["alliance"];
    $country = $_POST["country"];
    $w_l = $_POST["w_l"];
    $coop = $_POST["coop"];

    $ins_sql = "INSERT INTO players_games VALUES ('$name', '$game', '$alliance', '$country', '$w_l', '$coop')";
    if ($conn->query($ins_sql) === TRUE) {
        echo "<script type='text/javascript'>window.close()</script>";
    } else {
        echo "Error: " . $ins_sql . "<br>" . $conn->error;
    }
    $conn->close();
?>