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

    $name = $_POST['name'];
    $game = $_POST['game'];

    $del_sql = "DELETE FROM players_games WHERE player_id = $name AND game_id = $game";
    if ($conn->query($del_sql) === TRUE) {
        echo "<script type='text/javascript'>window.close()</script>";
    } else {
        echo "Error: " . $del_sql . "<br>" . $conn->error;
    }
    $conn->close();
?>