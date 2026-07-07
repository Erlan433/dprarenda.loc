<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    
    $rooms = array();
    if(isset($_POST["seek"])){
        $search = $_POST["search"];
        $sql = "SELECT * FROM rooms WHERE title LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM rooms";
    }
    $result = $conn->query($sql);
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
    <link rel="icon" href="/images/dpr-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css?m=<?php echo rand() ?>">
    <link rel="stylesheet" href="/css/home/common.css?m=<?php echo rand() ?>">
    <link rel="stylesheet" href="/css/home/style.css?m=<?php echo rand() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="logo">DPR</a>
            <span class="telefon">
                <a href="tel:+79782311637"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978) 231-16-37</p>
            </span>
        </div>
    </header>
    <main>
        <h1>Наши объекты</h1>

        <div class="category">
            <div class="subtitle">
                <h2>Складские помещения</h2>
                <span><p>Посмотреть все</p><i class="fa-solid fa-arrow-right"></i></span>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                        <p class="price"><?php echo $rooms[$i][2]?> ₽</p>
                        <p class="square_price"><?php echo $rooms[$i][6]?> ₽</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $rooms[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="btn-pustPomesh">
                            <span>Подробнее</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endfor ?>
            </div>
        </div>

        <div class="category">
            <div class="subtitle">
                <h2>Торговые помещения</h2>
                <span><p>Посмотреть все</p><i class="fa-solid fa-arrow-right"></i></span>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                        <p class="price"><?php echo $rooms[$i][2]?> ₽</p>
                        <p class="square_price"><?php echo $rooms[$i][6]?> ₽</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $rooms[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="btn-pustPomesh">
                            <span>Подробнее</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endfor ?>
            </div>
        </div>

        <div class="category">
            <div class="subtitle">
                <h2>Площадки</h2>
                <span><p>Посмотреть все</p><i class="fa-solid fa-arrow-right"></i></span>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                        <p class="price"><?php echo $rooms[$i][2]?> ₽</p>
                        <p class="square_price"><?php echo $rooms[$i][6]?> ₽</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $rooms[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="btn-pustPomesh">
                            <span>Подробнее</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endfor ?>
            </div>
        </div>

        <div class="category">
            <div class="subtitle">
                <h2>Офисные помещения</h2>
                <span><p>Посмотреть все</p><i class="fa-solid fa-arrow-right"></i></span>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                        <p class="price"><?php echo $rooms[$i][2]?> ₽</p>
                        <p class="square_price"><?php echo $rooms[$i][6]?> ₽</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $rooms[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="btn-pustPomesh">
                            <span>Подробнее</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                <?php endfor ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <p class="copyright">&copy; 2026 Все права защищены</p>
        </div>
    </footer>

    <div class="cover" style="display: none;"></div>
</body>
</html>