<?php
$host = "localhost";       // Хост (обычно localhost)
$username = "root";         // Имя пользователя MySQL
$password = "";             // Пароль пользователя MySQL (если есть)
$database = "arendadpr";   // Имя базы данных

// Устанавливаем соединение с базой данных
$conn = new mysqli($host, $username, $password, $database);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Устанавливаем кодировку соединения (важно для правильной работы с кириллицей)
$conn->set_charset("utf8mb4");

// Функция для выполнения SQL запросов (чтобы код был чище)
function query($sql) {
    global $conn; // Доступ к переменной $conn внутри функции
    $result = $conn->query($sql);
    if (!$result) {
        echo "Ошибка в SQL запросе: " . $conn->error . "<br>";
        echo "Запрос: " . $sql . "<br>"; // Выводим запрос для отладки
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
