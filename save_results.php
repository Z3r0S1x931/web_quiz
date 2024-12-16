<?php
// Подключаемся к базе данных
$dsn = 'sqlite:quiz_results.db';  // Путь к вашей базе данных SQLite
$username = '';
$password = '';
$options = [];

try {
    // Подключаемся к базе данных
    $db = new PDO($dsn, $username, $password, $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем параметры из GET-запроса
    $correct_answers = isset($_GET['correct']) ? (int)$_GET['correct'] : 0;
    $errors = isset($_GET['errors']) ? (int)$_GET['errors'] : 0;
    $timestamp = date("Y-m-d H:i:s");

    // Добавляем запись в таблицу с результатами
    $stmt = $db->prepare("INSERT INTO quiz_results (correct_answers, errors, timestamp) VALUES (:correct, :errors, :timestamp)");
    $stmt->bindParam(':correct', $correct_answers);
    $stmt->bindParam(':errors', $errors);
    $stmt->bindParam(':timestamp', $timestamp);

    if ($stmt->execute()) {
        // Успешно добавлено
        echo "Результаты успешно сохранены!";
    } else {
        // Если запрос не выполнен
        echo "Не удалось сохранить данные!";
    }

} catch (PDOException $e) {
    // Если произошло исключение, выводим ошибку
    echo "Ошибка: " . $e->getMessage();
}
?>
