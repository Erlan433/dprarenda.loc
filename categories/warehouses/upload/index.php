<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";

    if(isset($_POST["level_floor"])){
        $level_floor = $_POST["level_floor"];
        echo $level_floor;
        exit();
    }

    $sql = "SELECT id, title, price, picture, location, square_price FROM rooms WHERE category = 1";
    $result = $conn->query($sql);
    $warehouses = $result->fetch_all();

?>

<?php for($i = 0; $i < count($warehouses); $i++): ?>
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
<?php endfor; ?>