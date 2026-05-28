<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    
    $rooms = array();
    $search = "";
    $filter = "";
    if(isset($_POST["seek"])){
        $search = $_POST["search"];
        $sql = "SELECT * FROM rooms WHERE title LIKE '%$search%'";
        $result = query($sql);
        if ($result && $result->num_rows > 0) {
            $rooms = $result->fetch_all();
        }
    } else if(isset($_GET["filter"])) {
        $filter = $_GET["filter"];
        if($filter == "rent"){
            $sale = 0;
        } else {
            $sale = 1;
        }
        $sql = "SELECT * FROM rooms WHERE sale = $sale";
        $result = query($sql);
        if ($result && $result->num_rows > 0) {
            $rooms = $result->fetch_all();
        }
    } else {
        $sql = "SELECT * FROM rooms";
        $result = query($sql);
        if ($result && $result->num_rows > 0) {
            $rooms = $result->fetch_all();
        }
    }
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

        <form action="" method="post">
            <input type="hidden" name="seek" value="1">
            <input type="text" name="search" placeholder="Поиск..." value="<?php echo $search ?>">
            <input type="submit" value="Найти">
        </form>

        <div>
            <a href="?" style="<?php echo ($filter == '' ? 'border: 2px solid black' : '') ?>">Все</a>
            <a href="?filter=rent" style="<?php echo ($filter == 'rent' ? 'border: 2px solid black' : '') ?>">В аренду</a>
            <a href="?filter=sale" style="<?php echo ($filter == 'sale' ? 'border: 2px solid black' : '') ?>">В продажу</a>
        </div>

        <div class="pustPomesheniya container">
            <?php for($i = 0; $i < count($rooms); $i++): ?>
                <div class="pustPomesh">
                    <a href="/item/?i=<?php echo $rooms[$i][0]?>" class="img" style="background-image: url(<?php echo $rooms[$i][4]?>)"></a>
                    <a class="title" href="/item/?i=<?php echo $rooms[$i][0]?>"><?php echo $rooms[$i][1]?></a>
                    <p class="price"><?php echo $rooms[$i][2]?> ₽<?php echo ($rooms[$i][5] == 0 ? " в аренду" : "") ?></p>
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
</body>
</html>