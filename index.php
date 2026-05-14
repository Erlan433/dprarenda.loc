<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    $sql = "SELECT * FROM rooms";
    $result = query($sql);
    $rooms = array();
    if ($result && $result->num_rows > 0) {
        $rooms = $result->fetch_all();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPR &mdash; продажа пустых помещений</title>
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
            <a href="/" class="logo">DPR </a>
            <span class="telefon">
                <a href="tel:+79787777777"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978)777-77-77</p>
            </span>
        </div>
    </header>
    <main>
        <h1>Пустые помещения</h1>

        <div class="pustPomesheniya container">
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <div class="pustPomesh">
                    <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                    <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                    <p class="price"><?php echo $rooms[$i][2]?> ₽<?php echo ($rooms[$i][5] == 0 ? " в аренду" : "") ?></p>
                    <span class="location">
                        <i class="fa-solid fa-location-dot"></i>г. Симферополь
                    </span>
                    <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="btn-pustPomesh">
                        <span>Подробнее</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            <?php endfor ?>
            <?php if(count($rooms) == 0): ?>
                <h2>Пустых помещений нет!</h2>
            <?php endif ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p class="copyright">&copy; 2026 Все права защищены</p>
        </div>
    </footer>
</body>
</html>