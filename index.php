<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DPR</title>
    <link rel="icon" href="./images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://kit.fontawesome.com/d38ec0eb27.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="home.html" class="logo">DPR</a>
        <div class="dropDown1">
            <div class="user">
                <p>Пользователь</p>
                <i class="fa-solid fa-caret-down"></i>
            </div>
            <div class="admin">
                <a href="pswrdAdmn.php">Админ</a>
            </div>
        </div> 
    </header>
    <main>
        <h1>Пустые помещения</h1>

        <div class="pustPomesheniya">
            <?php
            require_once './db.php';

            $sql = "SELECT * FROM rooms";
            $result = query($sql);

            if ($result && $result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="pustPomesh">
                        <?php echo $row['image']?>
                        <div class="ttlAndPrc">
                            <h2 class="title"><?php echo $row['title']?></h2>
                            <p class="price"><?php echo $row['price']?></p>
                        </div>
                        <p class="dscrptn"><?php echo $row['description']?></p>
                    </div>
                    <?php
                }

                echo "</table>";
            } else {
                ?>
                <p class="p1">Нет помещений</p> 
                <?php
            }

            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <p class="telefon">+7(978)777-77-77</p>
    </footer>
</body>
</html>