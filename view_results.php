<?php
// view_results.php

$dsn = 'sqlite:quiz_results.db';  
try {
    // Подключаемся к базе данных
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Запрашиваем все результаты
    $stmt = $db->query('SELECT * FROM quiz_results ORDER BY timestamp DESC');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Отображаем таблицу
    echo "<h1>Результаты тестов</h1>";
    echo "<table border='1'>
            <tr><th>Правильных Ответов</th><th>Ошибок</th><th>Дата и Время</th></tr>";
    foreach ($results as $row) {
        echo "<tr><td>{$row['correct_answers']}</td><td>{$row['errors']}</td><td>{$row['timestamp']}</td></tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
