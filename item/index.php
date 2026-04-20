<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    if(isset($_GET["i"])){
        $id = $_GET["i"];
        $sql = "SELECT title, price, description, picture FROM rooms WHERE id = $id";
        $result = query($sql);
        $room = $result->fetch_row();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPR</title>
    <link rel="icon" href="/images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://kit.fontawesome.com/d38ec0eb27.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="logo">DPR</a>
            <p class="telefon">+7(978)777-77-77</p>
        </div>
    </header>
    <main>
       <div class="container main-content">
            <div class="left">
                <h1><?php echo $room[0] ?></h1>
                <img src="<?php echo $room[3] ?>" alt="foto">
                <h2>Описание</h2>
                <p class="item-description"><?php echo $room[2] ?></p>
            </div>
            <div class="right">
                <p class="item-price"><?php echo $room[1] ?> ₽</p>
            </div>
       </div> 
    </main>
    <footer>
        <div class="container">
            <p class="copyright">&copy; 2026 Все права защищены</p>
        </div>
    </footer>
</body>
</html>