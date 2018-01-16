<!--
Tekijä: Petri Rämö
Opiskelijanro:0438578
Pvm: 17.12.2017
-->

<!--
    This file puts username and password hash to database.
-->

<?php
require_once("utils.php");

function reg($name, $pass) {

    $db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_146cec21630c8d9;charset=utf8', 'b5b1fee7b2a995', '398e1009');

    $pw = sha1($pass . RANDOMISER);

    $sql = $db->prepare("INSERT INTO users(username, pass_hash) VALUES(:v1, :v2)");

    $sql->execute(array(":v1" => $name, ":v2" => $pw));


    regSuccess();
}