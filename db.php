<?php

$conn = new mysqli("localhost", "root", "", "arendadpr");

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

function query($sql) {
    global $conn;
    $result = $conn->query($sql);
    if (!$result) {
        echo "Ошибка в SQL запросе: " . $conn->error . "<br>";
        echo "Запрос: " . $sql . "<br>";
        return false;
    }
    return $result;
}

function getRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = random_int(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

?>
