<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();

    if(isset($_POST["i"])){
        $id = $_POST["i"];
        $sql = "SELECT picture FROM pictures WHERE id = $id";
        $result = $conn->query($sql);
        $picture = $result->fetch_row();
        unset($picture[0]);
        $sql = "DELETE FROM pictures WHERE id = $id";
        $conn->query($sql);
        echo 1;
    }
?>