<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    if(isset($_POST["legal_address"])){
        $legal_address = $_POST["legal_address"];
        $air_conditining = $_POST["air_conditining"];
        $water_supply = $_POST["water_supply"];
        $sewerage = $_POST["sewerage"];
        $insert = "";
        if($legal_address == "true"){
            $insert .= " AND o.legal_address = 1";
        }
        if($air_conditining == "true"){
            $insert .= " AND o.air_conditining = 1";
        }
        if($water_supply == "true"){
            $insert .= " AND o.water_supply = 1";
        }
        if($sewerage == "true"){
            $insert .= " AND o.sewerage = 1";
        }
        
        $sql = "SELECT r.id, r.title, r.price, r.picture, r.location, r.square_price FROM rooms r, offices o WHERE o.room_id = r.id AND r.category = 4 $insert";
        $result = $conn->query($sql);
        $offices = $result->fetch_all();
    } else {
        $sql = "SELECT id, title, price, picture, location, square_price FROM rooms WHERE category = 4";
        $result = $conn->query($sql);
        $offices = $result->fetch_all();
    }
?>

<?php for($i = 0; $i < count($offices); $i++): ?>
    <div class="pustPomesh">
        <a href="/item/?i=<?php echo $offices[$i][0]?>" class="img" style="background-image: url(<?php echo $offices[$i][3]?>)"></a>
        <a class="title" href="/item/?i=<?php echo $offices[$i][0]?>"><?php echo $offices[$i][1]?></a>
        <p class="price"><?php echo $offices[$i][2]?> ₽ в месяц</p>
        <p class="square_price"><?php echo $offices[$i][5]?> ₽ за м²</p>
        <span class="location">
            <i class="fa-solid fa-location-dot locatoin-dot"></i><?php echo $offices[$i][4]?>
        </span>
        <a href="/item/?i=<?php echo $offices[$i][0]?>" class="btn-pustPomesh">
            <span>Подробнее</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
<?php endfor; ?>