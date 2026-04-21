<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    if(isset($_POST["check"]) && $_POST["select"] == "delete"){
        $del = implode(",", $_POST["check"]);
        for($i = 0; $i < count($_POST["check"]); $i++){
            $room = $_POST["check"][$i];
            $sql = "SELECT picture FROM rooms WHERE id = $room";
            $result = $conn->query($sql);
            $foto = $result->fetch_row();
            unlink($_SERVER["DOCUMENT_ROOT"]. $foto[0]);
        }
        $sql = "DELETE FROM rooms WHERE id IN ($del)";
        $conn->query($sql);
    }
    $sql = "SELECT id, title, picture FROM rooms";
    $result = $conn->query($sql);
    $rooms = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_DPR</title>
</head>
<body>
    <main class="container">
        <form action="" method="post">
            <select name="select" id="select">
                <option value="no">-------</option>
                <option value="delete">Удалить</option>
            </select>
            <input type="submit" value="Применить">
            <ul>
                <?php for($i = 0; $i < count($rooms); $i++): ?>
                    <li>
                        <input type="checkbox" name="check[]" id="check<?php echo $rooms[$i][0] ?>" value="<?php echo $rooms[$i][0] ?>">
                        <img src="<?php echo $rooms[$i][2] ?>" alt="foto" height="50">
                        <label for="check<?php echo $rooms[$i][0] ?>"><?php echo $rooms[$i][1] ?></label> 
                    </li>
                <?php endfor ?>
            </ul>
        </form>
    </main>
</body>
</html>