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

    # отображение даты и режима игры +
    $sql2 = "SELECT * FROM games";
    $result2 = $conn->query($sql2);

    $g_id = 1;
    $last_g_id = 0;
    if ($result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            while ($g_id != $row['id']) {
                $g_id++;
            }
            if ($g_id == $row['id']) {
                $last_g_id++;
                echo "<th class='th3'>Game ".$last_g_id.'<br>'.$row["date"]."<br>".$row["modification"]." ".$row["mode"]."</th>";
            } else {
                $g_id++;
            }
            $ins_no = "UPDATE games SET no_g = $last_g_id WHERE id = $g_id";
            if ($conn->query($ins_no) !== TRUE) { 
                echo "Error: " . $ins_no . "<br>" . $conn->error;
            }

        }
    } else {
        echo "<tr><td style='background-color:#f4cccc;height:50px;width:134px;>0 results</td></tr>";
    }
    $conn->close();
?>