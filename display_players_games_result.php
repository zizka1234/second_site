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

    # отображение данных игрока в игре +

    #echo "<td style='width: 133.54px;height: 20.4px;'>";
    $sql3 = "SELECT player_id, game_id, alliance, country, w_l, coop, no_p, no_g FROM players_games INNER JOIN players ON players_games.player_id=players.id INNER JOIN games ON players_games.game_id=games.id ORDER BY player_id";
    $result3 = $conn->query($sql3);

    # ид последней игры
    $max_id_game_sql = "SELECT MAX(id) as max_id FROM games";
    $res_max_id_game = $conn->query($max_id_game_sql);
    if ($res_max_id_game->num_rows > 0) {
        while($row = $res_max_id_game->fetch_assoc()) {
            $max_id_game = $row['max_id'];
        }
    }
    # переменные g_id ид игры и p_id ид игрока
    $g_id = 1;
    $p_id = 1;
    $last_p_id = 0;
    echo "<tr style='height:22px;'>";
    if ($result3->num_rows > 0) {
        while($row = $result3->fetch_assoc()) {
            # проверка предыдущего игрока с текущим    
            while ($p_id != $row['no_p']) {
                $p_id++;
                $g_id = 1;
                echo "<tr style='height:22px;'>";
            }

            # отображение данных
            if ($p_id == $row['no_p']) {
                # проверки ид игры

                while ($g_id != $row['no_g']) {
                    if ($g_id == $max_id_game) {
                        break;
                    }
                    $g_id++;
                    echo "<td> </td>"; # если игрок не играл то пустота
                }

                # если игрок играл то отображение данных
                if ($g_id == $row['no_g']) {
                    if ($row['coop'] == 1) {
                        if ($row['w_l'] == 1) { # если победа  то зеленый фон
                            if ($row['alliance'] == "allies") {
                                echo "<td style='background-color: #d4edbc;' id='td3'>".' '.$row['country'].' coop win'."</td>";
                            } else {
                                echo "<td style='background-color: #11734b;' id='td3'>".' '.$row['country'].' coop win'."</td>";
                            }
                        } else { # если поражение то красный фон
                            if ($row['alliance'] == "axis") {
                                echo "<td style='background-color: #b10202;' id='td3'>".' '.$row['country'].' coop lose'."</td>";
                            } else {
                                echo "<td style='background-color: #ffcfc9;' id='td3'>".' '.$row['country'].' copp lose'."</td>";
                            }
                        }
                    } else {
                        if ($row['w_l'] == 1) { # если победа  то зеленый фон
                            if ($row['alliance'] == "allies") {
                                echo "<td style='background-color: #d4edbc;' id='td3'>".' '.$row['country'].' win'."</td>";
                            } else {
                                echo "<td style='background-color: #11734b;' id='td3'>".' '.$row['country'].' win'."</td>";
                            }
                        } else { # если поражение то красный фон
                            if ($row['alliance'] == "axis") {
                                echo "<td style='background-color: #b10202;' id='td3'>".' '.$row['country'].' lose'."</td>";
                            } else {
                                echo "<td style='background-color: #ffcfc9;' id='td3'>".' '.$row['country'].' lose'."</td>";
                            }
                        }
                    }
                    $g_id++;
                }
            }
            #echo "<tr><td>".$row['player_id'].' '.$row['game_id']."</td></tr>";
        }
    } else {
        echo "<td>0 results</td></tr>";
    }
    $conn->close();
?>