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

    # отображение списка игроков в <select>
    echo "<select class='butons' name='game'>";
    $sql = "SELECT id FROM games";
    $result = $conn->query($sql);
    $g_id = 1;
    $last_g_id = 0;
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            while ($g_id != $row['id']) {
                $g_id++;
            }
            if ($g_id == $row['id']) {
                $last_g_id++;
                echo "<option value='".$row['id']."'>".'Game '.$last_g_id."</option>";
            } else {
                $g_id++;
            }
        }
    } else {
        echo "<option>0 results</option>";
    }
    echo "</select>";
    $conn->close();
?>