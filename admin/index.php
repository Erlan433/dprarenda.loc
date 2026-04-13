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
    <div class="form">
        <h1>Админские операции</h1>
        <a href="/admin/new/" class="newAdminButn">Cоздать новое</a>
        <a href="/admin/edit/" class="changeAdmnButn">Редактировать</a>
        <a href="" class="deletAdmnButn">Удалить</a>
        <a href="/logout/" class="exitAdminButn">Выйти</a>
    </div>
</body>
</html>