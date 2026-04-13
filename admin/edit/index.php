<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    $sql = "SELECT id, title, price, picture FROM rooms";
    $result = $conn->query($sql);
    $rooms = $result->fetch_all();
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
        <ul>
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <li>
                    <img src="<?php echo $rooms[$i][3] ?>" alt="foto" height="50">
                    <a href="/admin/edit/item/?r=<?php echo $rooms[$i][0] ?>"><?php echo $rooms[$i][1] ?></a> 
                    <span><?php echo $rooms[$i][2] ?> ₽</span>
                </li>
            <?php endfor ?>
        </ul>
    </main>
</body>
</html>