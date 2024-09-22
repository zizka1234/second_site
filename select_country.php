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

    echo "<select class='butons' name='country'>";
    $sql1 = "SELECT name FROM majors";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        while ($row = $result1 -> fetch_assoc()) {
            echo "<option value='".$row['name']."' style='background-color:#9900ff;'>".$row['name']."</option>";
        }
    } else {
        echo "<option>0 results</option>";
    }

    $sql2 = "SELECT name FROM minors";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = $result2 -> fetch_assoc()) {
            echo "<option value='".$row['name']."' style='background-color:#c266ff;'>".$row['name']."</option>";
        }
    } else {
        echo "<option>0 results</option>";
    }
    echo "</select>";
    $conn->close();
?>