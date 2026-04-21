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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_DPR</title>
</head>
<body>
    <main class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <label for="title">Название</label>
            <input type="text" name="title" id="title" value="<?php echo $room[0] ?>">
            <label for="price">Цена</label>
            <input type="number" name="price" id="price" value="<?php echo $room[1] ?>">
            <label for="description">Описание</label>
            <textarea name="description" id="description"><?php echo $room[2] ?></textarea>
            <label for="foto">Фотография</label>
            <img src="<?php echo $room[3] ?>" alt="foto">
            <input type="file" name="foto" id="foto">
            <input type="hidden" name="old_foto" value="<?php echo $room[3] ?>">
            <select name="sale" id="select">
                <option value="0">Аренда</option>
                <option value="1" <?php echo ($room[4] == 1 ? "selected" : "") ?>>Продажа</option>
            </select>
            <input type="submit" value="Сохранить">
        </form>
    </main>
</body>
</html>