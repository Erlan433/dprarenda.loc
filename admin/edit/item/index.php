<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $title = $_POST["title"];
        $price = $_POST["price"];
        $square_price = $_POST["square_price"];
        $location = $_POST["location"];
        $description = preg_replace("/\n/", "<br>", ($_POST["description"]));
        $image = $_POST["old_foto"];
        $sale = $_POST["sale"];
        $lat = $_POST["lat"];
        $lon = $_POST["lon"];
        if(isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($finfo, $_FILES["foto"]["tmp_name"]);
            finfo_close($finfo);
            $name = getRandomString(22);
            if($filetype == "image/jpeg" || $filetype == "image/gif" || $filetype == "image/png"){
                $filename = $name.".".strtolower(substr(strrchr(basename($_FILES["foto"]["name"]), "."), 1));
                $fname = "/images/".$filename;
                $path = $_SERVER["DOCUMENT_ROOT"];
                if(move_uploaded_file($_FILES["foto"]["tmp_name"], $path.$fname)){
                    unlink($path.$image);
                    $image = $fname;
                }
            }
        }
        $sql = "UPDATE rooms SET title = '$title', price = '$price', description = '$description', picture = '$image', sale = '$sale', location = '$location', square_price = '$square_price', lat = '$lat', lon = '$lon' WHERE id = '$id'";
        $conn->query($sql);
        header("Location: /admin/edit/");
    } else if(isset($_GET["r"])) {
        $id = $_GET["r"];
        $sql = "SELECT title, price, description, picture, sale, location, square_price, lat, lon FROM rooms WHERE id = $id";
        $result = $conn->query($sql);
        $room = $result->fetch_row();
        $room[2] = preg_replace("<<br>>", "\n", $room[2]);
        $sql = "SELECT id, picture FROM pictures WHERE room_id = $id";
        $result = $conn->query($sql);
        $pictures = $result->fetch_all();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DPR</title>
    <link rel="icon" href="/images/dpr-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://api-maps.yandex.ru/2.1/?apikey=4c10efde-32c8-4e71-8c69-1b34c8931969&lang=ru_RU" type="text/javascript"></script>
</head>
<body>
    <main class="container">
        <form class="edit-card" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="old_foto" value="<?php echo $room[3] ?>">

            <div class="edit-card-content">
                <div class="edit-left">
                    <div class="edit-card-header">
                        <i class="fa-regular fa-building fa-2x"></i>
                        <h2>Редактирование помещения</h2>
                    </div>
    
                    <p class="photo-title">
                        <i class="fa-regular fa-image"></i> Главная фотография помещения
                    </p>
                    <img src="<?php echo $room[3] ?>" alt="Фото" class="edit-photo-preview" id="photo-preview">
    
                    <div class="block-foto">
                        <input type="file" name="foto" id="foto" accept="image/jpeg,image/png,image/gif">
                        <label for="foto" class="foto-label">
                            <i class="fa-regular fa-image fa-2x icon-image"></i>
                            <span class="foto-label-text">Выберите файл</span>
                            <span class="foto-label-hint">JPG, PNG, GIF</span>
                        </label>
                    </div>

                    <hr>

                    <input type="file" id="file_select" onchange="uploadImg(this.files, <?php echo $id ?>)" accept="image/jpeg,image/png,image/gif">
                    <input type="button" id="add_pictures" value="добавить фото">

                    <div class="fotos">
                        <?php for($i = 0; $i < count($pictures); $i++): ?>
                            <div class="img-item" style="background-image: url(<?php echo $pictures[$i][1] ?>);">
                                <span class="cross" title="Удалить" id="del-<?php echo $pictures[$i][0] ?>" onclick="deletePic(<?php echo $pictures[$i][0] ?>)">&times;</span>
                            </div>
                            
                        <?php endfor ?>
                    </div>
                </div>
    
                <div class="edit-right">
                    <div class="label-input">
                        <label for="title">Название помещения</label>
                        <input type="text" name="title" id="title" value="<?php echo $room[0] ?>" placeholder="Введите название помещения">
                    </div>
                    <div class="label-input">
                        <label for="price">Цена (₽)</label>
                        <input type="number" name="price" id="price" value="<?php echo $room[1] ?>" placeholder="Введите цену помещения">
                    </div>
                    <div class="label-input">
                        <label for="square_price">Цена за квадртный метр (₽)</label>
                        <input type="number" name="square_price" id="square_price" value="<?php echo $room[6] ?>" placeholder="Введите цену за квадртный метр">
                    </div>
                    <div class="label-input">
                        <label for="location">Местоположение</label>
                        <input type="text" name="location" id="location" value="<?php echo $room[5] ?>" placeholder="Введите местоположение помещения">

                        <a href="#" class="map-button">Показать на карте</a>
                    </div>
                    <div class="label-input">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" placeholder="Введите описание помещения"><?php echo $room[2] ?></textarea>
                    </div>
                    <div class="label-input">
                        <label for="select">Тип</label>
                        <div class="select" id="select">
                            <button type="button" class="select-btn"><span><?php echo ($room[4] == 1 ? "Продажа" : "Аренда") ?></span><i class="fa-solid fa-chevron-down"></i></button>
                            <div class="drop-down" style="display: none;">
                                <label for="arenda">Аренда</label>
                                <input type="radio" id="arenda" value="0" name="sale" <?php echo ($room[4] == 0) ? 'checked' : ''; ?>>
                                <label for="prodaja">Продажа</label>
                                <input type="radio" id="prodaja" value="1" name="sale" <?php echo ($room[4] == 1) ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="lat" value="0" id="lat">
            <input type="hidden" name="lon" value="0" id="lon">

            <div class="edit-footer">
                <a href="/admin/edit/" class="return">Отмена</a>
                <input type="submit" value="Сохранить" class="safe-btn">
            </div>
        </form>
    </main>

    <div class="cover-map" style="display: none;"></div>
    <div class="map-modal" style="display: none;">
        <p id="close-map">&times;</p>
        <div id="YMapsID" style="width:600px;height:400px"></div>
    </div>

    <script src="/js/admin/modal-map.js"></script>
    <script src="/js/admin/select-admin.js"></script>
    <script src="/js/script.js"></script>
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

            moscow_map.events.add("click", function(event){
                moscow_map.geoObjects.removeAll()
                const coords = event.get("coords");
                const placeMark = new ymaps.Placemark(coords, {
                    balloonContent: "Местоположение",
                    hintContent: "Местоположение"
                }, {
                    preset: "islands#dotIcon",
                    iconColor: "#ff0000"
                });
                moscow_map.geoObjects.add(placeMark);
                document.getElementById("lat").value = coords[0];
                document.getElementById("lon").value = coords[1]; 
            })
        });
    </script>
</body>
</html>
