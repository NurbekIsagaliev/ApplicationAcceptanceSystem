<?php
// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $date = date("Y-m-d H:i:s"); // текущая дата и время
    $ip = $_SERVER["REMOTE_ADDR"];
    $referer = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "Direct";

    // Создание директории demands, если её нет
    $directory = "demands";
    if (!is_dir($directory)) {
        mkdir($directory, 0600);
    }

    // Создание CSV-файла с именем demands-{Y}{m}{d}.csv
    $filename = $directory . "/demands-" . date("Ymd") . ".csv";

    // Запись данных в CSV-файл
    $data = [$name, $phone, $date, $ip, $referer];
    $file = fopen($filename, "a");
    fputcsv($file, $data);
    fclose($file);

    echo "Заявка успешно сохранена!";
} else {
    // Если форма не была отправлена, перенаправьте пользователя на главную страницу или другую страницу
    header("Location: index.html");
    exit();
}
?>
