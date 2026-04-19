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
    <script src="https://kit.fontawesome.com/d38ec0eb27.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="form">
        <h1>Админские операции</h1>
        <div class="adminOperations">
            <a href="/admin/new/" class="newAdminButn">
                <i class="fa-solid fa-plus"></i>
                Cоздать
            </a>
            <a href="/admin/edit/" class="editAdmnButn">
                <i class="fa-solid fa-pen"></i>
                Редактировать
            </a>
            <a href="/admin/delete/" class="deletAdmnButn">
                <i class="fa-solid fa-trash"></i>
                Удалить
            </a>
        </div>
        <a href="/logout/" class="exitAdminButn">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Выйти
        </a>
    </div>
</body>
</html>