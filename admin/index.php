<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: /login/");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_DPR</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <div class="glass">
        <h1>Админские операции</h1>
        <div class="operatButns">
            <button class="newAdminButn">Cоздать новое</button>
            <button class="changeAdmnButn">Редактировать</button>
            <button class="deletAdmnButn">Удалить</button>
        </div>
        <a href="/logout/" class="exitAdminButn">Выйти c Админа</a>
    </div>
</body>
</html>