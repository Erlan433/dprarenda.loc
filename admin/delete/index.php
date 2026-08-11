<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    if(isset($_POST["check"]) && $_POST["select"] == "delete"){
        $del = implode(",", $_POST["check"]);
        for($i = 0; $i < count($_POST["check"]); $i++){
            $room = $_POST["check"][$i];
            $sql = "SELECT picture FROM rooms WHERE id = $room";
            $result = $conn->query($sql);
            $foto = $result->fetch_row();
            unlink($_SERVER["DOCUMENT_ROOT"]. $foto[0]);
        }
        $sql = "DELETE FROM warehouses WHERE room_id IN ($del)";
        $conn->query($sql);
        $sql = "DELETE FROM shops WHERE room_id IN ($del)";
        $conn->query($sql);
        $sql = "DELETE FROM spaces WHERE room_id IN ($del)";
        $conn->query($sql);
        $sql = "DELETE FROM offices WHERE room_id IN ($del)";
        $conn->query($sql);
        $sql = "DELETE FROM rooms WHERE id IN ($del)";
        $conn->query($sql);
    }
    $sql = "SELECT id, title, picture, category FROM rooms";
    $result = $conn->query($sql);
    $rooms = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DPR</title>
    <link rel="icon" href="/siteImgs/dpr-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin/admin-common.css">
    <link rel="stylesheet" href="/css/admin/admin-delete.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <form class="form" action="" method="post">
        <h1>Удалить объект</h1>
        <div class="delete-toolbar">
            <div class="select" id="select">
                <button type="button" class="select-btn select-btn-delete"><span>-------</span><i class="fa-solid fa-chevron-down"></i></button>
                <div class="drop-down drop-down-delete" style="display: none">
                    <input type="radio" id="arenda" value="no" name="select" checked>
                    <label for="arenda">-------</label>
                    <input type="radio" id="prodaja" value="delete" name="select">
                    <label for="prodaja">Удалить</label>
                </div>
            </div>
            <input type="submit" value="Применить" class="apply-btn">
        </div>
        <ul class="delete-list">
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <li>
                    <img src="<?php echo $rooms[$i][2] ?>" alt="foto">
                    <input type="checkbox" name="check[]" id="check<?php echo $rooms[$i][0] ?>" value="<?php echo $rooms[$i][0] ?>">
                    <label for="check<?php echo $rooms[$i][0] ?>"><?php echo $rooms[$i][1] ?></label>
                    <?php 
                        $category_id = $rooms[$i][3];
                        $sql = "SELECT category_name, rus_name FROM categories WHERE id = $category_id";
                        $result = $conn->query($sql);
                        $category = $result->fetch_row();
                    ?>
                    <p class="<?php echo $category[0] ?>"><?php echo $category[1] ?></p>
                </li>
            <?php endfor ?>
        </ul>
        <a href="/admin/" class="return">Вернуться</a>
    </form>

    <script src="/js/admin/select-admin.js"></script>
</body>
</html>