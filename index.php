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
    echo $sale;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPR &mdash; продажа пустых помещений</title>
    <link rel="icon" href="/images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css?m=<?php echo rand() ?>">
    <link rel="stylesheet" href="/css/main.css?m=<?php echo rand() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="logo">DPR </a>
            <span class="telefon">
                <a href="tel:+79787777777"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978) 231-16-37</p>
            </span>
        </div>
    </header>
    <main>
        <h1>Пустые помещения</h1>

        <div class="filters">
            <div class="filter">
                <!-- ФИЛЬТР -->
                 <div style="position: relative;">
                     <button class="button-filter"><i class="fa-solid fa-filter"></i> Фильтр</button>
                     <div class="drop-down" style="display: none">
                         <button class="filter-select-price">Цена</button>
                         <button class="filter-select-square-price">Цена за м²</button>
                     </div>
                 </div>

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

            <!-- ФОРМОЧКА ФИЛЬТРА ЦЕНЫ -->
            <form action="" method="post" class="price-modal" id="price-modal" style="display: none;">
                <input type="hidden" name="total" value="1">
                <input type="hidden" name="sale" value="<?php echo $sale ?>">
                <div class="xmark" id="xmark-price"><i class="fa-solid fa-xmark" id="xmark"></i></div>
                <div class="modal-h2" id="modal-h2-price"><h2>Фильтр цены</h2></div>
                <label for="from">От</label>
                <input type="number" name="from" id="from" placeholder="0">
                <label for="to">До</label>
                <input type="number" name="to" id="to" placeholder="&infin;">
                <input type="submit" value="Показать">
            </form>

            <!-- ФОРМОЧКА ФИЛЬТРА ЦЕНЫ ЗА КВАДРАТНЫЙ МЕТР -->
            <form action="" method="post" class="square-price-modal" id="square-price-modal" style="display: none;">
                <input type="hidden" name="meter" value="1">
                <input type="hidden" name="sale" value="<?php echo $sale ?>">
                <div class="xmark" id="xmark-square-price"><i class="fa-solid fa-xmark" id="xmark"></i></div>
                <div class="modal-h2"><h2>Фильтр цены за м²</h2></div>
                <label for="from">От</label>
                <input type="number" name="from" id="from" placeholder="0">
                <label for="to">До</label>
                <input type="number" name="to" id="to" placeholder="&infin;">
                <input type="submit" value="Показать">
            </form>
    
            <!-- ВЫБОР ТИПА -->
            <div class="selectType">
                <a href="?" style="<?php echo ($sale == -1 ? 'border: 2px solid rgb(0, 150, 255)' : '') ?>">Все</a>
                <a href="?filter=rent" style="<?php echo ($sale == 0 ? 'border: 2px solid rgb(0, 150, 255)' : '') ?>">В аренду</a>
                <a href="?filter=sale" style="<?php echo ($sale == 1 ? 'border: 2px solid rgb(0, 150, 255)' : '') ?>">В продажу</a>
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
                        <i class="fa-solid fa-location-dot"></i><?php echo $rooms[$i][6]?>
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

    <script src="/js/select-filter.js"></script>
</body>
</html>