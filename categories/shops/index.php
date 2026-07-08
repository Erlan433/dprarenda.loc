<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    
    $rooms = array();
    $search = "";
    $filter = "";
    $sale = -1;
    if(isset($_POST["seek"])){
        $search = $_POST["search"];
        $sql = "SELECT * FROM rooms WHERE title LIKE '%$search%'";
    } else if(isset($_POST["total"])) {
        $sales = $_POST["sale"] == -1 ? "0,1" : $_POST["sale"];
        $sale = $_POST["sale"];
        $from = $_POST["from"] != "" ? $_POST["from"] : 0;
        $to = $_POST["to"] != "" ? $_POST["to"] : 1000000000;
        $sql = "SELECT * FROM rooms WHERE price BETWEEN $from AND $to AND sale IN ($sales)";
    } else if(isset($_POST["meter"])) {
        $sales = $_POST["sale"] == -1 ? "0,1" : $_POST["sale"];
        $sale = $_POST["sale"];
        $from = $_POST["from"] != "" ? $_POST["from"] : 0;
        $to = $_POST["to"] != "" ? $_POST["to"] : 1000000000;
        $sql = "SELECT * FROM rooms WHERE square_price BETWEEN $from AND $to AND sale IN ($sales)";
    } else if(isset($_GET["filter"])) {
        $filter = $_GET["filter"];
        if($filter == "rent"){
            $sale = 0;
        } else {
            $sale = 1;
        }
        $sql = "SELECT * FROM rooms WHERE sale = $sale";
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
    <link rel="stylesheet" href="/css/home/categories/shops.css?m=<?php echo rand() ?>">
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
        <h1>Торговые помещения</h1>
        <div class="filter">
            <!-- ФИЛЬТР -->
            <button class="button-filter"><i class="fa-solid fa-filter"></i> Фильтр</button>

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
        </div>

        <!-- ПУСТЫЕ ПОМЕЩЕНИЯ -->
        <div class="pustPomesheniya container">
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <div class="pustPomesh">
                    <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                    <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                    <p class="price"><?php echo $rooms[$i][2]?> ₽<?php echo ($rooms[$i][5] == 0 ? " в месяц" : "") ?></p>
                    <p class="square_price"><?php echo $rooms[$i][7]?> ₽<?php echo ($rooms[$i][5] == 0 ? " за м² в месяц" : " за м²") ?></p>
                    <span class="location">
                        <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $rooms[$i][6]?>
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

    <div class="cover" style="display: none;"></div>
</body>
</html>