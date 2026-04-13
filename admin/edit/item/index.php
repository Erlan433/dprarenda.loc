<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $title = $_POST["title"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $old_image = $_POST["old_image"];
    } else if(isset($_GET["r"])) {
        $id = $_GET["r"];
        $sql = "SELECT title, price, description, picture FROM rooms WHERE id = $id";
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
            <input type="submit" value="Сохранить">
        </form>
    </main>
</body>
</html>