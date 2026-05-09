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
        $sale = $_POST["sale"];
        if (isset($_FILES["foto"])){
            if($_FILES["foto"]["error"] == 0){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $filetype = finfo_file($finfo, $_FILES["foto"]["tmp_name"]);
                finfo_close($finfo);
                if ($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif"){
                    $exp = explode(".", $_FILES["foto"]["name"]);
                    $fname = "/images/".getRandomString(20).".".end($exp);
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $root.$fname);
                    $sql = "INSERT INTO rooms (title, price, description, picture, sale) VALUES ('$title', '$price', '$description', '$fname', '$sale')";
                    $conn->query($sql);
                }
            }
        }
    }
?>

<!DOCTYPE html>
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
        <h1>Добавление помещения</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="new" value="1">
            <div class="label-input">
                <label for="title">Название помещения</label>
                <input type="text" name="title" id="title" placeholder="Введите название помещения">
            </div>
            <div class="label-input">
                    <label for="price">Цена (₽)</label>
                    <input type="number" name="price" id="price" placeholder="Введите цену помещения">
            </div>
            <div class="label-input">
                <label for="description">Описание</label>
                <textarea name="description" id="description" placeholder="Введите описание помещения"></textarea>
            </div>
            <div class="new-block-foto">
                <p class="photo-title">
                    <i class="fa-regular fa-image"></i> Главная фотография помещения
                </p>
                <div class="block-foto">
                    <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/gif">
                    <label for="foto" class="foto-label">
                        <i class="fa-regular fa-image fa-2x icon-image"></i>
                        <span class="foto-label-text">Выберите фотографию</span>
                        <span class="foto-label-hint">JPG, PNG, GIF</span>
                    </label>
                </div>
            </div>
            <div class="label-input">
                <label for="select">Тип</label>
                <select name="sale" id="select">
                    <option value="0">Аренда</option>
                    <option value="1">Продажа</option>
                </select>
            </div>
            <input type="submit" value="сохранить" class="safe-btn">
        </form>
        <a href="/admin/" class="return">Вернуться</a>
    </div>
    <script src="/js/script.js"></script>
</body>
</html>