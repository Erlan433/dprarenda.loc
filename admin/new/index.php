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
        $square_price = $_POST["square_price"];
        $location = $_POST["location"];
        $description = preg_replace("/\n/", "<br>", ($_POST["description"]));
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
                    $sql = "INSERT INTO rooms (title, price, description, picture, sale, location, square_price) VALUES ('$title', '$price', '$description', '$fname', '$sale', '$location', '$square_price')";
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
    <title>Admin DPR</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <main class="container">
        <form class="edit-card" action="" method="post" enctype="multipart/form-data">
            <input type="hidden">

            <div class="edit-card-content">
                <div class="edit-left">
                    <div class="edit-card-header">
                        <i class="fa-regular fa-building fa-2x"></i>
                        <h2>Добавление помещения</h2>
                    </div>

                    <div>
                        <p class="photo-title">
                            <i class="fa-regular fa-image"></i> Главная фотография помещения
                        </p>
                        <div class="block-foto">
                            <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/gif">
                            <label for="foto" class="foto-label">
                                <i class="fa-regular fa-image fa-2x icon-image"></i>
                                <span class="foto-label-text">Выберите файл</span>
                                <span class="foto-label-hint">JPG, PNG, GIF</span>
                            </label>
                        </div>
                    </div>

                    <div class="label-input">
                        <label for="location">Местоположение</label>
                        <input type="text" name="location" id="location" placeholder="Введите местоположение помещения">
                    </div>

                    <div class="label-input">
                        <label for="select">Тип</label>
                        <div class="select" id="select">
                            <button type="button" class="select-btn"><span>Аренда</span><i class="fa-solid fa-chevron-down"></i></button>
                            <div class="drop-down" style="display: none">
                                <label for="arenda">Аренда</label>
                                <input type="radio" id="arenda" value="0" name="sale">
                                <label for="prodaja">Продажа</label>
                                <input type="radio" id="prodaja" value="1" name="sale">
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="edit-right">
                    <div class="label-input">
                        <label for="title">Название помещения</label>
                        <input type="text" name="title" id="title" placeholder="Введите название помещения">
                    </div>

                    <div class="label-input">
                        <label for="price">Цена (₽)</label>
                        <input type="number" name="price" id="price" placeholder="Введите цену помещения">
                    </div>

                    <div class="label-input">
                        <label for="square_price">Цена за квадртный метр (₽)</label>
                        <input type="number" name="square_price" id="square_price" placeholder="Введите цену за квадртный метр">
                    </div>

                    <div class="label-input">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" placeholder="Введите описание помещения"></textarea>
                    </div>
                </div>
            </div>

            <div class="edit-footer">
                <a href="/admin/" class="return">Отмена</a>
                <input type="submit" value="Сохранить" class="safe-btn">
            </div>
        </form>
    </main>
    <script src="/js/select-admin.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>