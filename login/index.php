<?php
    include $_SERVER["DOCUMENT_ROOT"]."/db.php";
    session_start();
    if(isset($_SESSION['email'])){
        header("Location: /");
    }
    $message = "";
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "SELECT password FROM admin WHERE email = '$email'";
        $result = query($sql);
        if($result->num_rows > 0){
            $data = $result->fetch_row();
            if($password == $data[0]){
                $_SESSION["email"] = $email;
                $message = "Успешный вход";
                header("Location: /admin/");
            }else{
                $message = "Неверный пароль";
            }
        }else{
            $message = "Неверный email";
        }
    }
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proverka</title>
    <link rel="icon" href="./images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="glass">
        <h1>Проверка пароля</h1>
        <form action="" method="post">
            <input type="hidden" name="login" value="1">
            <input type="text" placeholder="Введите email" name="email">
            <input type="password" placeholder="Введите пароль" name="password">
            <button type="submit">Войти</button>
            <p><?php echo $message ?></p>
        </form>
    </div>
</body>
</html>