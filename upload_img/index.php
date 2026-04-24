<?php
    $root = $_SERVER["DOCUMENT_ROOT"];
    include $root."/db.php";
    $id = $_POST["id"];    
    if (isset($_FILES["picture"])){
        if($_FILES["picture"]["error"] == 0){
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $filetype = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);
            finfo_close($finfo);
            if ($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif"){
                $exp = explode(".", $_FILES["picture"]["name"]);
                $fname = "/images/".getRandomString(20).".".end($exp);
                move_uploaded_file($_FILES["picture"]["tmp_name"], $root.$fname);
                // $sql = "INSERT INTO pictures (title, price, description, picture, sale) VALUES ('$title', '$price', '$description', '$fname', '$sale')";
                // $conn->query($sql); остановились здесь !!!
            }
        }
    }
?>