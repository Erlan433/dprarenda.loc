<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    $sql = "SELECT id, title, picture FROM rooms";
    $result = $conn->query($sql);
    $rooms = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_DPR</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
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
                    </li>
                </a>
            <?php endfor ?>
        </ul>
        <a href="/admin/" class="return">Вернуться</a>
    </main>
</body>
</html>