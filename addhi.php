<!--
Tekijä: Petri Rämö
Opiskelijanro:0438578
Pvm: 17.12.2017
-->

<!--
    This file adds new highscores from the single player game to the highscores table in database. It also only lets 10 highcores to be in that table.
-->

<?php

require_once("index.php");

if(isset($_SESSION["username"]) && isset($_POST["jsonScore"])) {
    $db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_146cec21630c8d9;charset=utf8', 'b5b1fee7b2a995', '398e1009');

    $score = json_decode($_POST["jsonScore"], true);

    $sql = $db->prepare("INSERT INTO highscores(username, score) VALUES(:v1, :v2)");

    $sql->execute(array(":v1" => $_SESSION["username"], ":v2" => (int)$score["score"]));

    $sql = $db->prepare("SELECT * FROM highscores ORDER BY score DESC");

    $sql->execute();

    $counter = 0;

    foreach($sql->fetchALL(PDO::FETCH_ASSOC) as $v) {
        $counter += 1;

        if ($counter > 10) {
            $sql2 = $db->prepare("DELETE FROM highscores WHERE hiid=:v1");
            $sql2->execute(array(":v1" => $v["hiid"]));
        }
    }

}


?>