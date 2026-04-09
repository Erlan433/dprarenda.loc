<?php
    $root = $_SERVER["DOCUMENT_ROOT"];
    include $root."/db.php";
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: /login/");
    }

    if (isset($_POST["new"])){
        $title = $_POST["title"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        if (isset($_FILES["foto"])){
            if($_FILES["foto"]["error"] == 0){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($finfo, $_FILES["foto"]["tmp_name"]);
                finfo_close($finfo);
                if ($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif"){
                    $exp = explode(".", $_FILES["foto"]["name"]);
                    $fname = "/images/".getRandomString(20).".".end($exp);
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $root.$fname);
                    $sql = "INSERT INTO rooms (title, price, description, picture) VALUES ('$title', '$price', '$description', '$fname')";
                    $conn->query($sql);
                }
            }
        }
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
        <h1>Добавление помещения</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1">
            <input type="text" name="title" placeholder="Введите название помещения">
            <input type="number" name="price" placeholder="Введите цену помещения">
            <input type="text" name="description" placeholder="Введите описание помещения">
            <input type="file" name="foto">
            <input type="submit" value="сохранить">
        </form>
        <a href="/logout/" class="exitAdminButn">Выйти c Админа</a>
    </div>
</body>
</html>