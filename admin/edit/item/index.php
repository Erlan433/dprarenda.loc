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
        $lat = $_POST["lat"];
        $lon = $_POST["lon"];
        $sql = "SELECT category FROM rooms WHERE id = $id";
        $result = $conn->query($sql);
        $category = $result->fetch_column();
        if($category == 1){
            $ceiling_height = $_POST["ceiling_height"];
            $level_floor = $_POST["level_floor"];
            $ramp_access = $_POST["ramp_access"];
            $crane_beam = $_POST["crane_beam"];
        } elseif($category == 2){
            $ramp_access = $_POST["ramp_access"];
            $sewerage = $_POST["sewerage"];
            $crane_beam = $_POST["crane_beam"];
            $water_supply = $_POST["water_supply"];
            $level_floor = $_POST["level_floor"];
        } elseif($category == 4){
            $legal_address = $_POST["legal_address"];
            $air_conditining = $_POST["air_conditining"];
            $water_supply = $_POST["water_supply"];
            $sewerage = $_POST["sewerage"];
        }

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
        $sql = "UPDATE rooms SET title = '$title', price = '$price', description = '$description', picture = '$image', location = '$location', square_price = '$square_price', lat = '$lat', lon = '$lon' WHERE id = '$id'";
        $conn->query($sql);
        if($category == 1){
            $sql = "UPDATE warehouses SET ceiling_height = '$ceiling_height', level_floor = '$level_floor', ramp_access = '$ramp_access', crane_beam = '$crane_beam' WHERE room_id = '$id'";
        } elseif($category == 2){
            $sql = "UPDATE shops SET ramp_access = '$ramp_access', sewerage = '$sewerage', crane_beam = '$crane_beam', water_supply = '$water_supply', level_floor = '$level_floor' WHERE room_id = '$id'";
        } elseif($category == 4){
            $sql = "UPDATE offices SET legal_address = '$legal_address', air_conditining = '$air_conditining', water_supply = '$water_supply', sewerage = '$sewerage' WHERE room_id = '$id'";
        }
        $conn->query($sql);
        header("Location: /admin/edit/");
    } else if(isset($_GET["r"])) {
        $id = $_GET["r"];
        $sql = "SELECT title, price, description, picture, location, square_price, lat, lon, category FROM rooms WHERE id = $id";
        $result = $conn->query($sql);
        $room = $result->fetch_row();
        $room[2] = preg_replace("<<br>>", "\n", $room[2]);
        $sql = "SELECT id, picture FROM pictures WHERE room_id = $id";
        $result = $conn->query($sql);
        $pictures = $result->fetch_all();
        if($room[8] == 1){
            $sql = "SELECT ceiling_height, level_floor, ramp_access, crane_beam FROM warehouses WHERE room_id = $id";
            $rus_text = "склад";
            $eng_text = "warehouses";
        } else if($room[8] == 2){
            $sql = "SELECT ramp_access, sewerage, crane_beam, water_supply, level_floor FROM shops WHERE room_id = $id";
            $rus_text = "магазин";
            $eng_text = "shops";
        }else if($room[8] == 3){
            $rus_text = "площадка";
            $eng_text = "spaces";
        } else if($room[8] == 4){
            $sql = "SELECT legal_address, air_conditining, water_supply, sewerage FROM offices WHERE room_id = $id";
            $rus_text = "офис";
            $eng_text = "offices";
        }
        $result = $conn->query($sql);
        $category_details = $result->fetch_row();
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin DPR</title>
    <link rel="icon" href="/siteImgs/dpr-logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/admin/admin-common.css">
    <link rel="stylesheet" href="/css/admin/admin-edits/admin-item.css">
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

                    <p class="photo-title">
                        <i class="fa-regular fa-image"></i> Дополнительные фотографии
                    </p>

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
                    <h2 class="<?php echo $eng_text ?>"><?php echo $rus_text ?></h2>

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
                        <input type="number" name="square_price" id="square_price" value="<?php echo $room[5] ?>" placeholder="Введите цену за квадртный метр">
                    </div>

                    <div class="label-input">
                        <label for="location">Местоположение</label>
                        <input type="text" name="location" id="location" value="<?php echo $room[4] ?>" placeholder="Введите местоположение помещения">

                        <a href="#" class="map-button">Показать на карте</a>
                    </div>

                    <div class="label-input">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description" placeholder="Введите описание помещения"><?php echo $room[2] ?></textarea>
                    </div>

                    <?php if($room[8] == 1): ?>
                        <div class="label-input">
                            <label for="ceiling_height">Высота потолка</label>
                            <input type="number" step="0.1" name="ceiling_height" id="ceiling_height" value="<?php echo $category_details[0] ?>" placeholder="Введите высоту потолка">
                        </div class="category-checkbox">

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[1] == 1 ? "checked" : "")?> name="level_floor" id="level_floor" value="1">
                            <label for="level_floor">Ровный пол</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[2] == 1 ? "checked" : "")?> name="ramp_access" id="ramp_access" value="1">
                            <label for="ramp_access">Наличие рампа</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[3] == 1 ? "checked" : "")?> name="crane_beam" id="crane_beam" value="1">
                            <label for="crane_beam">Наличие кран-балки</label>
                        </div>
                    <?php elseif($room[8] == 2): ?>
                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[0] == 1 ? "checked" : "")?> name="ramp_access" id="ramp_access" value="1">
                            <label for="ramp_access">Наличие рампа</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[1] == 1 ? "checked" : "")?> name="sewerage" id="sewerage" value="1">
                            <label for="sewerage">Наличие канализации</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[2] == 1 ? "checked" : "")?> name="crane_beam" id="crane_beam" value="1">
                            <label for="crane_beam">Наличие кран-балки</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[3] == 1 ? "checked" : "")?> name="water_supply" id="water_supply" value="1">
                            <label for="water_supply">Водоснабжение</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[4] == 1 ? "checked" : "")?> name="level_floor" id="level_floor" value="1">
                            <label for="level_floor">Ровный пол</label>
                        </div>

                    <?php elseif($room[8] == 4): ?>
                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[0] == 1 ? "checked" : "")?> name="legal_address" id="legal_address" value="1">
                            <label for="legal_address">Возможность оформления юридического адреса</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[1] == 1 ? "checked" : "")?> name="air_conditining" id="air_conditining" value="1">
                            <label for="air_conditining">Наличие кондиционера</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[2] == 1 ? "checked" : "")?> name="water_supply" id="water_supply" value="1">
                            <label for="water_supply">Водоснабжение</label>
                        </div>

                        <div class="category-checkbox">
                            <input type="checkbox" <?php echo ($category_details[3] == 1 ? "checked" : "")?> name="sewerage" id="sewerage" value="1">
                            <label for="sewerage">Наличие канализации</label>
                        </div>
                    <?php endif; ?>

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
    <script src="/js/admin/pick-foto.js"></script>
    <script src="/js/admin/upload-img.js"></script>
    <script type="text/javascript">
        let edit = false;
        ymaps.ready(function(){
            const coords = [<?php echo $room[6] ?>, <?php echo $room[7] ?>];
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
