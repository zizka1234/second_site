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
    echo "<select class='butons' name='name'>";
    $sql = "SELECT id, name FROM players";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row['id']."'>".$row['name']."</option>";
        }
    } else {
        echo "<option>0 results</option>";
    }
    echo "</select>";
    $conn->close();
?>