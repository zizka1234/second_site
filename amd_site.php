<DOCTYPE! html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="30">  -->
    <title>Хойка</title>
    <link rel="stylesheet" href="styl_i copy 2.css">
</head>
<body>  
    <header>
        <table id="table_1">
            <tr>
                <th style="background-color: #93c47d;">WIN +20 MMR</th>
                <th style="background-color: #e06666;">LOSE -20 MMR</th>
                <th style="background-color: #ff00ff;">S - 2500</th>
                <th style="background-color: #9900ff;">A+ - 2400</th>
                <th style="background-color: #0000ff;">A - 2300</th>
                <th style="background-color: #4a86e8;">B+ - 2200</th>
                <th style="background-color: #00ffff;">B - 2100</th>
                <th style="background-color: #00ff00;">C+ - 2000</th>
                <th style="background-color: #ffff00;">C - 1900</th>
                <th style="background-color: #ff9900;">C - 1800</th>
                <th style="background-color: #ff0000;">F - 1800></th>
            </tr>
        </table>
        <!-- <a href="insert_date_index.html"><input type="button" value="inset_date"></a> -->

    </header>
    <div class='form'>
        <!-- добавление игр + -->
        <div class="forms">
            add player
            <form action="insert_player.php" method="post" target="_blank">
                <input class="butons" type="text" name="name"><br>
                <input class="butons" type="submit">
            </form>
        </div>
        <!-- добавление игрока + -->
        <div class="forms">
            add game
            <form action="insert_game.php" target="_blank" method="post">
                <input class="butons" type="date" name="date_1"><br>
                <input class="butons" type="text" name="modifi"><br>
                <input class="butons" type="text" name="mod"><br>
                <input type="submit">
            </form>
        </div>
        <!-- добавление результатов игрока + -->
        <div class="forms">
            add player result
            <form action="isnert_result.php" target="_blank" method="post">
                select player
                <?php
                    require("select_players_form.php");
                ?>
                
                <br>
                select game
                <?php
                    require("select_games_form.php");
                ?>
                <br>
                <input type="radio" name="alliance" value="allies">allies
                <input type="radio" name="alliance" value="axis">axis
                <?php
                    require("select_country.php");
                ?>
                <br>
                <input class="butons" type="checkbox" name="coop" value="1">coop
                <br>
                <input class="butons" type="checkbox" name="w_l" value="1">w_l
                <br>
                <input class="butons" type="submit">
            </form>
        </div>
        <!-- удаление игрока + -->
        <div class="forms">
            <form action="del_player.php" target="_blank" method="post">
                delet player
                <br>
                <?php
                    require("select_players_form.php");
                ?>
                <br>
                <input class="butons" type="submit">
            </form>
        </div>
        <!-- удаление игры + -->
        <div class="forms">
            <form action="del_game.php" target="_blank" method="post">
                delet game
                <br>
                <?php
                    require("select_games_form.php");
                ?>
                <br>
                <input class="butons" type="submit">
            </form>
        </div>
        <!-- удаление рещультатов игрока + -->
        <div class="forms">
            <form action="del_p_result.php" target="_blank" method="post">
                del player result
                <br>
                select player
                <?php
                    require("select_players_form.php");
                ?>
                <br>
                select game
                <?php
                    require("select_games_form.php");
                ?>
                <br>
                <input class="butons" type="submit">
            </form>
        </div>
    </div>
    <br>
    <div class="main_conteiner_flex">
        <div id="left">
            <table id='table_2'>
                <tr style='height:22px;'>
                    <th colspan=10>Statistic</th>
                </tr>
                <tr style='position:sticky;top:24;'>
                    <th class="th2" style='background-color:#351c75;height:22px;'> No </th>
                    <th class="th2" style='background-color:#156082;height:22px;'> name </th>
                    <th class="th2" style='background-color:#fce5ff;height:22px;'> games </th>
                    <th class="th2" style='background-color:#fce5cd;height:22px;'> total mmr </th>
                    <th class="th2" style='background-color:#4a86e8;height:22px;'> mmr </th>
                    <th class="th2" style='background-color:#a4c2f4;height:22px;'> w - l </th>
                    <th class="th2" style='background-color:#6d9eeb;height:22px;'> wr </th>
                    <th class="th2" style='background-color:#666666;height:22px;'> mmr </th>
                    <th class="th2" style='background-color:#b7b7b7;height:22px;'> w - l </th>
                    <th class="th2" style='background-color:#999999;height:22px;'> wr </th>
                </tr>
                <?php
                    require("display_players_statistics.php");
                    require("update_statistics.php");
                ?>
            </table>
        </div>
        <div id="right">
            <table id="table_3">
                <tr>
                    <?php
                        require("display_players_games.php");
                    ?>
                </tr>
                <?php
                    require("display_players_games_result.php");
                ?>
            </table>
        </div>
    </div>
    <footer>
        <p>Rafael zizka123 Ramazanov</p>
    </footer>
</body>
</html>