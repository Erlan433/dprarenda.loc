<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    if(isset($_GET["i"])){
        $id = $_GET["i"];
        $sql = "SELECT title, price, description, picture, sale, location, square_price, lat, lon FROM rooms WHERE id = $id";
        $result = $conn->query($sql);
        $room = $result->fetch_row();
        $sql = "SELECT id, picture FROM pictures WHERE room_id = $id";
        $result = $conn->query($sql);
        $pictures = $result->fetch_all();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $room[0] ?></title>
    <link rel="icon" href="/images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4c10efde-32c8-4e71-8c69-1b34c8931969&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
    <header>
        <div class="container">
            <a href="/" class="logo">DPR </a>
            <span class="telefon">
                <a href="tel:+79782311637"><i class="fa-solid fa-phone"></i></a>
                <p>+7(978) 231-16-37</p>
            </span>
        </div>
    </header>
    <main>
       <div class="container main-content">
            <div class="item-left">
                <div class="item-main-foto" style="background-image: url(<?php echo $room[3] ?>);"></div>
                <div class="item-caruosel-fotos">
                    <button><i class="fa-solid fa-angle-left"></i></button>
                    <img class="item-caruosel-foto" src="<?php echo $room[3] ?>" alt="foto">
                    <?php for($i = 0; $i < count($pictures); $i++): ?>
                        <img class="item-caruosel-foto" src="<?php echo $pictures[$i][1] ?>" alt="foto">
                    <?php endfor; ?>
                    <button><i class="fa-solid fa-angle-right"></i></button>
                </div>
            </div>
            <div class="item-right">
                <div>
                    <h1><?php echo $room[0] ?></h1>
                    <span class="item-location">
                        <i class="fa-solid fa-location-dot"></i><?php echo $room[5]?>
                    </span>
                </div>
                <div class="item-prices">
                    <label for="item-price">Цена</label>
                    <p class="item-price" id="item-price"><?php echo $room[1]?> ₽<?php echo ($room[4] == 0 ? " в месяц" : "") ?></p>
                    <label for="item-square_price">Цена за м²</label>
                    <p class="item-square_price" id="item-square_price"><?php echo $room[6]?> ₽<?php echo ($room[4] == 0 ? " в месяц" : "") ?></p>
                </div>
                <div class="item-map">
                    <div id="YMapsID" style="width:100%;height:400px"></div>
                </div>
                <div class="item-call-container">
                    <a href="tel:+79782311637" class="item-call"><i class="fa-solid fa-phone"></i><span>Позвонить</span></a>
                </div>
                <div class="item-description-block">
                    <h2>Описание</h2>
                    <p class="item-description"><?php echo $room[2] ?></p>
                </div>
            </div>
       </div>
    </main>
    <footer>
        <div class="container">
            <p class="copyright">&copy; 2026 Все права защищены</p>
        </div>
    </footer>

    <script type="text/javascript">
        let edit = false;
        ymaps.ready(function(){
            const coords = [<?php echo $room[7] ?>, <?php echo $room[8] ?>];
            if(coords[0] == 0 && coords[1] == 0){
                coords[0] = 44.95;
                coords[1] = 34.1;
            }

            let moscow_map = new ymaps.Map("YMapsID", {
                center: coords,
                zoom: 10
            });

            const placeMark = new ymaps.Placemark(coords, {
                balloonContent: "Местоположение",
                hintContent: "Местоположение"
            }, {
                preset: "islands#dotIcon",
                iconColor: "#ff0000"
            });
            moscow_map.geoObjects.add(placeMark);
        })
    </script>
</body>
</html>