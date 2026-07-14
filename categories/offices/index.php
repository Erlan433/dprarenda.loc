<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    
    $search = "";
    if(isset($_POST["seek"])){
        $search = $_POST["search"];
        $sql = "SELECT * FROM rooms WHERE category = 4 AND title LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM rooms WHERE category = 4";
    }
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
    <link rel="stylesheet" href="/css/home/categories/offices.css?m=<?php echo rand() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="logo">DPR</a>
            <nav>
                <a href="/categories/warehouses/" class="nav-category nav-warehouses">Склады</a>
                <a href="/categories/shops/" class="nav-category nav-shops">Магазины</a>
                <a href="/categories/spaces/" class="nav-category nav-spaces">Площадки</a>
                <a href="/categories/offices/" class="nav-category nav-offices">Офисы</a>
            </nav>
            <span class="telefon">
                <a href="tel:+79782311637"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978) 231-16-37</p>
            </span>
        </div>
    </header>
    <main>
        <h1>Офисные помещения</h1>

        <!-- ПОИСКОВИК -->
        <div class="searchAndBtn">
            <form action="" method="post">
                <input type="hidden" name="seek" value="1">
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="search" placeholder="Поиск..." value="<?php echo $search ?>" autocomplete="off">
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>

        <div class="main-content container">
            <div class="filters">
                <form action="">
                    <div class="filter">
                        <h3>Цена, ₽</h3>
                        <div class="number-input">
                            <input type="number" placeholder="От">
                            <input type="number" placeholder="До">
                        </div>
                    </div>

                    <div class="filter">
                        <h3>Цена за м², ₽</h3>
                        <div class="number-input">
                            <input type="number" placeholder="От">
                            <input type="number" placeholder="До">
                        </div>
                    </div>

                    <div class="filter">
                        <h3>Дополнительные характеристики</h3>
                        <div class="checkbox-input">
                            <input type="checkbox" id="legal_address">
                            <label for="legal_address">Возможность оформления юридического адреса</label>
                        </div>
                        <div class="checkbox-input">
                            <input type="checkbox" id="air_conditining">
                            <label for="air_conditining">Кондиционер</label>
                        </div>
                        <div class="checkbox-input">
                            <input type="checkbox" id="water_supply">
                            <label for="water_supply">Водоснабжение</label>
                        </div>
                        <div class="checkbox-input">
                            <input type="checkbox" id="sewerage">
                            <label for="sewerage">Канализация</label>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- ПУСТЫЕ ПОМЕЩЕНИЯ -->
            <div class="pustPomesheniya">
                <?php for($i = 0; $i < count($offices); $i++): ?>
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
</body>
</html>