<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
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
    <link rel="stylesheet" href="/css/admin/admin-edits/admin-edit.css">
</head>
<body>
    <main class="form">
        <h1>Редактировать объект</h1>
        <ul>
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <a href="/admin/edit/item/?r=<?php echo $rooms[$i][0] ?>">
                    <li>
                        <img src="<?php echo $rooms[$i][2] ?>" alt="foto" height="50">
                        <p class="title"><?php echo $rooms[$i][1] ?></p>
                        <?php 
                            $category_id = $rooms[$i][3];
                            $sql = "SELECT category_name, rus_name FROM categories WHERE id = $category_id";
                            $result = $conn->query($sql);
                            $category = $result->fetch_row();
                        ?>
                        <p class="<?php echo $category[0] ?>"><?php echo $category[1] ?></p>
                    </li>
                </a>
            <?php endfor ?>
        </ul>
        <a href="/admin/" class="return">Вернуться</a>
    </main>
</body>
</html>