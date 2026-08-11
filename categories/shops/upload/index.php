<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    if(isset($_POST["ramp_access"])){
        $ramp_access = $_POST["ramp_access"];
        $sewerage = $_POST["sewerage"];
        $crane_beam = $_POST["crane_beam"];
        $water_supply = $_POST["water_supply"];
        $level_floor = $_POST["level_floor"];
        $insert = "";
        if($ramp_access == "true"){
            $insert .= " AND s.ramp_access = 1";
        }
        if($sewerage == "true"){
            $insert .= " AND s.sewerage = 1";
        }
        if($crane_beam == "true"){
            $insert .= " AND s.crane_beam = 1";
        }
        if($water_supply == "true"){
            $insert .= " AND s.water_supply = 1";
        }
        if($level_floor == "true"){
            $insert .= " AND s.level_floor = 1";
        }
        
        $sql = "SELECT r.id, r.title, r.price, r.picture, r.location, r.square_price FROM rooms r, shops s WHERE s.room_id = r.id AND r.category = 2 $insert";
        $result = $conn->query($sql);
        $shops = $result->fetch_all();
    } else {
        $sql = "SELECT id, title, price, picture, location, square_price FROM rooms WHERE category = 2";
        $result = $conn->query($sql);
        $shops = $result->fetch_all();
    }
?>

<?php for($i = 0; $i < count($shops); $i++): ?>
    <div class="pustPomesh">
        <a href="/item/?i=<?php echo $shops[$i][0]?>" class="img" style="background-image: url(<?php echo $shops[$i][3]?>)"></a>
        <a class="title" href="/item/?i=<?php echo $shops[$i][0]?>"><?php echo $shops[$i][1]?></a>
        <p class="price"><?php echo $shops[$i][2]?> ₽ в месяц</p>
        <p class="square_price"><?php echo $shops[$i][5]?> ₽ за м²</p>
        <span class="location">
            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $shops[$i][4]?>
        </span>
        <a href="/item/?i=<?php echo $shops[$i][0]?>" class="btn-pustPomesh">
            <span>Подробнее</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
<?php endfor; ?>