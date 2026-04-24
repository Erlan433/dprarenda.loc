<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $title = $_POST["title"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $image = $_POST["old_foto"];
        $sale = $_POST["sale"];
        if(isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($finfo, $_FILES["foto"]["tmp_name"]);
            finfo_close($finfo);
            $name = getRandomString(22);
            if($filetype == "image/jpeg" || $filetype == "image/gif" || $filetype == "image/png"){
                $filename = $name.".".strtolower(substr(strrchr(basename($_FILES["foto"]["name"]), "."), 1));
                $fname = "/images/".$filename;
                $path = $_SERVER["DOCUMENT_ROOT"];
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $path.$fname)){
                    unlink($path.$image);
                    $image = $fname;
                }
            }
        }
        $sql = "UPDATE rooms SET title = '$title', price = '$price', description = '$description', picture = '$image', sale = '$sale' WHERE id = '$id'";
        $conn->query($sql);
        header("Location: /admin/edit/");
    } else if(isset($_GET["r"])) {
        $id = $_GET["r"];
        $sql = "SELECT title, price, description, picture, sale FROM rooms WHERE id = $id";
        $result = $conn->query($sql);
        $room = $result->fetch_row();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_DPR</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
    <script src="https://kit.fontawesome.com/d38ec0eb27.js" crossorigin="anonymous"></script>
</head>
<body>
    <main class="container">
        <form class="edit-card" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="old_foto" value="<?php echo $room[3] ?>">

            <div class="edit-card-content">
                <div class="edit-left">
                    <div class="edit-card-header">
                        <i class="fa-regular fa-building fa-2x"></i>
                        <h2>Редактирование помещения</h2>
                    </div>
    
                    <p class="edit-photo-title">
                        <i class="fa-regular fa-image"></i> Главная фотография помещения
                    </p>
                    <img src="<?php echo $room[3] ?>" alt="Фото" class="edit-photo-preview" id="photo-preview">
    
                    <div class="block-foto">
                        <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/gif">
                        <label for="foto" class="foto-label">
                            <i class="fa-regular fa-image fa-2x icon-image"></i>
                            <span class="foto-label-text">Выберите файл</span>
                            <span class="foto-label-hint">JPG, PNG, GIF</span>
                        </label>
                    </div>
                </div>
    
                <div class="edit-right">
                    <div class="edit-field">
                        <label for="title">Название помещения</label>
                        <input type="text" name="title" id="title" value="<?php echo $room[0] ?>">
                    </div>
                    <div class="edit-field">
                        <label for="price">Цена (₽)</label>
                        <input type="number" name="price" id="price" value="<?php echo $room[1] ?>">
                    </div>
                    <div class="edit-field">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description"><?php echo $room[2] ?></textarea>
                    </div>
                    <div class="edit-field">
                        <label for="select">Тип</label>
                        <select name="sale" id="select">
                            <option value="0">Аренда</option>
                            <option value="1" <?php echo ($room[4] == 1 ? "selected" : "") ?>>Продажа</option>
                        </select>
                    </div>
                    <input type="file" id="file_select" onchange="uploadImg(this.files, <?php ehco $id ?>)" accept="image/jpeg,image/png,image/gif">
                    <input type="button" id="add_pictures" value="добавить фото">
                </div>
            </div>

            <div class="edit-footer">
                <a href="/admin/edit/" class="return">Отмена</a>
                <input type="submit" value="Сохранить" class="safe-btn">
            </div>
        </form>
    </main>

    <script src="/js/script.js"></script>
</body>
</html>
