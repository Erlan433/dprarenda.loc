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
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $data = $result->fetch_row();
            if($password == $data[0]){
                $_SESSION["email"] = $email;
                header("Location: /admin/");
            }else{
                $message = "Неверный пароль";
            }
        }else{
            $message = "Неверный логин";
        }
    }
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login DPR</title>
    <link rel="icon" href="./images/помещение №1.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/login.css">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
    <div class="form">
        <h1>Проверка пароля</h1>
        <form action="" method="post">
            <input type="hidden" name="login" value="1">
            <div class="input-container">
                <i class="fas fa-envelope icon"></i>
                <input type="text" id="email" name="email" placeholder="Введите логин" class="custom-input">
            </div>

            <div class="input-container">
                <i class="fas fa-lock icon"></i>
                <input type="password" id="password" name="password" placeholder="Введите пароль" class="custom-input">
            </div>
            <button type="submit">Войти</button>
            <p class="msg"><?php echo $message ?></p>
        </form>
        <a href="/" class="return">Вернуться</a>
    </div>
</body>
</html>