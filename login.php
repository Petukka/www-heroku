<!--
Tekijä: Petri Rämö
Opiskelijanro:0438578
Pvm: 17.12.2017
-->

<!--
    This file searches the person from the database and errors if persons not found.
-->
<?php

function  in($name, $pass) {
    require_once("utils.php");

    $db = new PDO('mysql:host=eu-cdbr-west-01.cleardb.com;dbname=heroku_146cec21630c8d9;charset=utf8', 'b5b1fee7b2a995', '398e1009');

    $pw = sha1($pass . RANDOMISER);

    $sql = $db->prepare("SELECT userid, username FROM users WHERE username=:username AND pass_hash=:pass");

    $sql->execute(array(":username" => $name, ":pass" => $pw));

    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) === 1){
        $_SESSION["userID"] = $rows[0]["userid"];
        $_SESSION["username"] = $rows[0]["username"];

        header("location:/index.php?p=logged");
    } else {
        logError1();
    }
}


?>
