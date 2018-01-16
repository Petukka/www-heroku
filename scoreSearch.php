<!--
Tekijä: Petri Rämö
Opiskelijanro:0438578
Pvm: 17.12.2017
-->

<?php

function search() {

    require_once("index.php");
    $db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_146cec21630c8d9;charset=utf8', 'b5b1fee7b2a995', '398e1009');

    $sql = $db->prepare("SELECT * FROM highscores ORDER BY score DESC");
    $sql->execute();

    foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $v) {
        echo "<tr><td>" . $v["username"] . "</td><td>" . $v["score"] . "</td></tr>";
    }

}


?>
