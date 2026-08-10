<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    
    $sql = "SELECT * FROM rooms WHERE category = 1";
    $result = $conn->query($sql);
    $warehouses = $result->fetch_all();

    $sql = "SELECT * FROM rooms WHERE category = 2";
    $result = $conn->query($sql);
    $shops = $result->fetch_all();

    $sql = "SELECT * FROM rooms WHERE category = 3";
    $result = $conn->query($sql);
    $spaces = $result->fetch_all();

    $sql = "SELECT * FROM rooms WHERE category = 4";
    $result = $conn->query($sql);
    $offices = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPR &mdash; продажа пустых помещений</title>
    <link rel="icon" href="/siteImgs/dpr-logo.jpg" type="image/x-icon">
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
            <nav>
                <a href="/categories/warehouses/" class="nav-category">Склады</a>
                <a href="/categories/shops/" class="nav-category">Магазины</a>
                <a href="/categories/spaces/" class="nav-category">Площадки</a>
                <a href="/categories/offices/" class="nav-category">Офисы</a>
            </nav>
            <span class="telefon">
                <a href="tel:+79782311637"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978) 231-16-37</p>
            </span>
            <button class="nav-toggle" type="button" aria-label="Меню" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>
    <main>
        <h1>Наши объекты</h1>

        <div class="category">
            <div class="subtitle">
                <h2>Складские помещения</h2>
                <a href="/categories/warehouses/"><p><!-- текст в css --></p><i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $warehouses[$i][0]?>" class="img" style="background-image: url(<?php echo $warehouses[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $warehouses[$i][0]?>"><?php echo $warehouses[$i][1]?></a>
                        <p class="price"><?php echo $warehouses[$i][2]?> ₽ в месяц</p>
                        <p class="square_price"><?php echo $warehouses[$i][6]?> ₽ за м²</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $warehouses[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $warehouses[$i][0]?>" class="btn-pustPomesh">
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
                <a href="/categories/shops/"><p><!-- текст в css --></p><i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $shops[$i][0]?>" class="img" style="background-image: url(<?php echo $shops[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $shops[$i][0]?>"><?php echo $shops[$i][1]?></a>
                        <p class="price"><?php echo $shops[$i][2]?> ₽ в месяц</p>
                        <p class="square_price"><?php echo $shops[$i][6]?> ₽ за м²</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $shops[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $shops[$i][0]?>" class="btn-pustPomesh">
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
                <a href="/categories/spaces/"><p><!-- текст в css --></p><i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $spaces[$i][0]?>" class="img" style="background-image: url(<?php echo $spaces[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $spaces[$i][0]?>"><?php echo $spaces[$i][1]?></a>
                        <p class="price"><?php echo $spaces[$i][2]?> ₽ в месяц</p>
                        <p class="square_price"><?php echo $spaces[$i][6]?> ₽ за м²</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $spaces[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $spaces[$i][0]?>" class="btn-pustPomesh">
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
                <a href="/categories/offices/"><p><!-- текст в css --></p><i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="pustPomesh">
                        <a href="/item/?i=<?php echo $offices[$i][0]?>" class="img" style="background-image: url(<?php echo $offices[$i][4]?>)"></a>
                        <a class="title" href="/item/?i=<?php echo $offices[$i][0]?>"><?php echo $offices[$i][1]?></a>
                        <p class="price"><?php echo $offices[$i][2]?> ₽ в месяц</p>
                        <p class="square_price"><?php echo $offices[$i][6]?> ₽ за м²</p>
                        <span class="location">
                            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $offices[$i][5]?>
                        </span>
                        <a href="/item/?i=<?php echo $offices[$i][0]?>" class="btn-pustPomesh">
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
    <script src="/js/home/nav.js"></script>
</body>
</html>