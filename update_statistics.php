<?php
    #echo "<script>console.log()</script>";
    # проверка на подключение к базе +
    $localhost = "localhost";
    $user = "test_hoika_adm";
    $password = "";
    $database = "hoika";
    $conn = new mysqli($localhost,$user,$password,$database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    # количество игр +

    $count_games = "SELECT player_id, COUNT(game_id) AS count_id FROM players_games GROUP BY player_id";
    $res_count_games = $conn->query($count_games);

    if ($res_count_games->num_rows > 0) {
        while ($row = $res_count_games->fetch_assoc()) {
            $count_game = $row['count_id'];
            $player_id = $row['player_id'];
            $ins_game = "UPDATE players SET games = $count_game WHERE id = $player_id";
            if ($conn->query($ins_game) !== TRUE) {
                echo "Error: ". $ins_game . "<br>" . $conn->error;
            }
        }
    }

    # общий ммр

    # ммр союзники +-

    $win_lose_s = "SELECT player_id, alliance, country, w_l, coop FROM players_games ORDER BY player_id";
    $res_win_lose_s = $conn->query($win_lose_s);

    $minors_sql = "SELECT name FROM minors";
    $res_minors = $conn->query($minors_sql);
    $minors = $res_minors->fetch_assoc();

    $majors_sql = "SELECT name FROM majors";
    $res_majors = $conn->query($majors_sql);

    $mmr_s = 1000;
    $p_id = 0;


    if ($res_win_lose_s->num_rows > 0) {
        while ($row = $res_win_lose_s->fetch_assoc()) {
            $player_id = $row['player_id'];
            $alliance = $row['alliance'];
            $country = $row['country'];
            $w_l = $row['w_l'];
            $coop = $row['coop'];

            while ($p_id != $player_id) {
                $ins_mmr_s = "UPDATE players SET mmr_s = $mmr_s WHERE id = $p_id";
                if ($conn->query($ins_mmr_s) !== TRUE) {
                    echo "Error: ". $ins_mmr_s . "<br>" . $conn->error;
                }
                $p_id++;
                $mmr_s = 1000;
            }
            if ($p_id == $player_id) {
                if ($alliance == "allies") {
                    if ($w_l == 1) {
                        if ($coop == 1) {
                            $mmr_s += 10;
                        } else {
                            /*echo "<script>console.log('".$country."')</script>";
                            if (in_array("Mongolia",$minors)) {
                                echo "<script>console.log('Mongolia 1')</script>";
                            }
                            if (in_array($country, $minors)) {
                                
                                $mmr_s += 10;
                            } else {*/
                            $mmr_s += 20;
                            #}
                        }
                    } elseif ($w_l == 0) {
                        if ($coop == 1) {
                            $mmr_s -= 10;
                        } else {
                            /*if (in_array($country, $minors)) {
                                $mmr_s -= 10;
                            } else {*/
                            $mmr_s -= 20;
                            #}
                        }
                    }
                }
                $ins_mmr_s = "UPDATE players SET mmr_s = $mmr_s WHERE id = $p_id";
                if ($conn->query($ins_mmr_s) !== TRUE) {
                    echo "Error: ". $ins_mmr_s . "<br>" . $conn->error;
                }
            }
        }
    }

    # победы союзники +

    $wins_s_sql = "SELECT player_id, COUNT(w_l) AS wins FROM players_games WHERE w_l = 1 AND alliance = 'allies' GROUP BY player_id";
    $res_wins_s = $conn->query($wins_s_sql);

    if ($res_wins_s->num_rows > 0) {
        while($row = $res_wins_s->fetch_assoc()) {
            $player_id = $row['player_id'];
            $wins = $row['wins'];
            $ins_wins = "UPDATE players SET win_s = $wins WHERE id = $player_id";
            if ($conn->query($ins_wins) !== TRUE) {
                echo "Error: ". $ins_wins . "<br>" . $conn->error;
            }
        }
    }

    # поражения союзники +

    $lose_s_sql = "SELECT player_id, COUNT(w_l) AS loses FROM players_games WHERE w_l = 0 AND alliance = 'allies' GROUP BY player_id";
    $res_loses_s = $conn->query($lose_s_sql);

    if ($res_loses_s->num_rows > 0) {
        while($row = $res_loses_s->fetch_assoc()) {
            $player_id = $row['player_id'];
            $loses = $row['loses'];
            $ins_lose = "UPDATE players SET lose_s = $loses WHERE id = $player_id";
            if ($conn->query($ins_lose) !== TRUE) {
                echo "Error: ". $ins_lose . "<br>" . $conn->error;
            }
        }
    }

    # винрэйт союзники +

    $winrate_s_sql = "SELECT id, win_s, lose_s FROM players";
    $res_winrate_s = $conn->query($winrate_s_sql);

    if ($res_winrate_s->num_rows > 0) {
        while ($row = $res_winrate_s->fetch_assoc()) {
            $id = $row['id'];
            if (($row['win_s'] + $row['lose_s']) != 0) {
                $winrate = ($row['win_s'] / ($row['win_s'] + $row['lose_s'])) * 100;
                $ins_wn = "UPDATE players SET winrate_s = $winrate WHERE id = $id";
                if ($conn->query($ins_wn) !== TRUE) {
                    echo "Error: ". $ins_wn . "<br>" . $conn->error;
                }
            } else {
                $winrate = 0;
                $ins_wn = "UPDATE players SET winrate_s = $winrate WHERE id = $id";
                if ($conn->query($ins_wn) !== TRUE) {
                    echo "Error: ". $ins_wn . "<br>" . $conn->error;
                }
            }
        }
    }

    # ммр ось +-

    $win_lose_o = "SELECT player_id, alliance, w_l, coop FROM players_games ORDER BY player_id";
    $res_win_lose_o = $conn->query($win_lose_o);

    $minors = "SELECT name FROM minors";
    $res_minors = $conn->query($minors);

    $mmr_o = 1000;
    $p_id = 1;
    if ($res_win_lose_o->num_rows > 0) {
        while ($row = $res_win_lose_o->fetch_assoc()) {
            $player_id = $row['player_id'];
            $alliance = $row['alliance'];
            $w_l = $row['w_l'];
            $coop = $row['coop'];

            while ($p_id != $player_id) {
                $ins_mmr_o = "UPDATE players SET mmr_o = $mmr_o WHERE id = $p_id";
                if ($conn->query($ins_mmr_o) !== TRUE) {
                    echo "Error: ". $ins_mmr_o . "<br>" . $conn->error;
                }
                $p_id++;
                $mmr_o = 1000;
            }

            if ($p_id == $player_id) {
                if ($alliance == "axis") {
                    if ($w_l == 1) {
                        if ($coop == 1) {
                            $mmr_o += 10;
                        } else {
                            $mmr_o += 20;
                        }
                    } elseif ($w_l == 0) {
                        if ($coop == 1) {
                            $mmr_o -= 10;
                        } else {
                            $mmr_o -= 20;
                        }
                    }
                }
                $ins_mmr_o = "UPDATE players SET mmr_o = $mmr_o WHERE id = $p_id";
                if ($conn->query($ins_mmr_o) !== TRUE) {
                    echo "Error: ". $ins_mmr_o . "<br>" . $conn->error;
                }
            }
        }
    }

    # победы ось +

    $wins_o_sql = "SELECT player_id, COUNT(w_l) AS wins FROM players_games WHERE w_l = 1 AND alliance = 'axis' GROUP BY player_id";
    $res_wins_o = $conn->query($wins_o_sql);

    if ($res_wins_o->num_rows > 0) {
        while($row = $res_wins_o->fetch_assoc()) {
            $player_id = $row['player_id'];
            $wins = $row['wins'];
            $ins_wins = "UPDATE players SET win_o = $wins WHERE id = $player_id";
            if ($conn->query($ins_wins) !== TRUE) {
                echo "Error: ". $ins_wins . "<br>" . $conn->error;
            }
        }
    }

    # поражения ось +

    $lose_o_sql = "SELECT player_id, COUNT(w_l) AS loses FROM players_games WHERE w_l = 0 AND alliance = 'axis' GROUP BY player_id";
    $res_loses_o = $conn->query($lose_o_sql);

    if ($res_loses_o->num_rows > 0) {
        while($row = $res_loses_o->fetch_assoc()) {
            $player_id = $row['player_id'];
            $loses = $row['loses'];
            $ins_lose = "UPDATE players SET lose_o = $loses WHERE id = $player_id";
            if ($conn->query($ins_lose) !== TRUE) {
                echo "Error: ". $ins_lose . "<br>" . $conn->error;
            }
        }
    }

    # винрэйт ось +

    $winrate_o_sql = "SELECT id, win_o, lose_o FROM players";
    $res_winrate_o = $conn->query($winrate_o_sql);

    if ($res_winrate_o->num_rows > 0) {
        while ($row = $res_winrate_o->fetch_assoc()) {
            $id = $row['id'];
            if (($row['win_o'] + $row['lose_o']) != 0) {
                $winrate = ($row['win_o'] / ($row['win_o'] + $row['lose_o'])) * 100;
                $ins_wn = "UPDATE players SET winrate_o = $winrate WHERE id = $id";
                if ($conn->query($ins_wn) !== TRUE) {
                    echo "Error: ". $ins_wn . "<br>" . $conn->error;
                }
            } else {
                $winrate = 0;
                $ins_wn = "UPDATE players SET winrate_o = $winrate WHERE id = $id";
                if ($conn->query($ins_wn) !== TRUE) {
                    echo "Error: ". $ins_wn . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
?>