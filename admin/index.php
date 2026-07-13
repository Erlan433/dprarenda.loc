<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: /admin/login/");
    };
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DPR</title>
    <link rel="icon" href="/siteImgs/dpr-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin/admin-common.css">
    <link rel="stylesheet" href="/css/admin/admin-index.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <div class="form">
        <h1>Админские операции</h1>
        <div class="adminOperations">
            <a href="/admin/new/" class="operationButn">
                <i class="fa-solid fa-plus"></i>
                Cоздать
            </a>
            <a href="/admin/edit/" class="operationButn">
                <i class="fa-solid fa-pen"></i>
                Редактировать
            </a>
            <a href="/admin/delete/" class="operationButn">
                <i class="fa-solid fa-trash"></i>
                Удалить
            </a>
        </div>
        <a href="/admin/logout/" class="exitAdminButn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Выйти
        </a>
    </div>
</body>
</html>