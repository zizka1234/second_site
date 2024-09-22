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

    # отображение игроков и статистики +
    $sql1 = "SELECT * FROM players";
    $result1 = $conn->query($sql1);

    $p_id = 1;
    $last_p_id = 0;
    if ($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) {
            while ($p_id != $row['id']) {
                $p_id++;
            }
            if ($p_id == $row['id']) {
                $last_p_id++;
                echo "<tr style='height:22px'><td class='td2' style='background-color:white;'>".$last_p_id."</td><td class='td2' style='background-color:#f4cccc;'>".$row["name"]."</td><td class='td2' style='background-color:#fce5ff;'>".$row["games"]."</td><td class='td2' style='background-color:#fce5cd;'>".$row["total_mmr"]."</td><td class='td2' style='background:#4a86e8;'>".$row["mmr_s"]."</td><td class='td2' style='background-color:#a4c2f4;'>".$row["win_s"].' - '.$row["lose_s"]."</td><td class='td2' style='background:#6d9eeb;'>".$row["winrate_s"]."%"."</td><td class='td2' style='background:#666666;'>".$row["mmr_o"]."</td><td class='td2' style='background-color:#b7b7b7;'>".$row["win_o"].' - '.$row["lose_o"]."</td><td class='td2' style='background-color:#999999;'>".$row["winrate_o"]."%"."</td></tr>";
            } else {
                $p_id++;
            }
            $ins_no = "UPDATE players SET no_p = $last_p_id WHERE id = $p_id";
            if ($conn->query($ins_no) !== TRUE) { 
                echo "Error: " . $ins_no . "<br>" . $conn->error;
            }
        } 
    } else {
    echo "<tr style='height:22px;'><td td style='background-color:white;'>0 results</td></tr>";
    }
    $conn->close();
?>