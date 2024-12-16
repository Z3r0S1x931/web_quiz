<?php
session_start();

// Количество вопросов
$total_questions = count($_SESSION['questions']);
$correct_answers = $_SESSION['score'];
$errors = $total_questions - $correct_answers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты теста</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Подключаем Chart.js -->
</head>
<body>
    <h1>Результат</h1>
    <p>Правильные ответы: <?= $correct_answers ?></p>
    <p>Ошибки: <?= $errors ?></p>

    <!-- Элемент для графика -->
    <canvas id="resultChart" width="400" height="200"></canvas>

    <script>
        // Получаем правильные ответы и ошибки из PHP переменных
        var correctAnswers = <?= $correct_answers ?>;
        var wrongAnswers = <?= $errors ?>;

        // Создаем график
        var ctx = document.getElementById('resultChart').getContext('2d');
        var resultChart = new Chart(ctx, {
            type: 'bar',  // Столбчатый график
            data: {
                labels: ['Правильно', 'Ошибки'], // Метки для столбцов
                datasets: [{
                    label: 'Количество',
                    data: [correctAnswers, wrongAnswers],  // Данные (правильные ответы и ошибки)
                    backgroundColor: ['#4caf50', '#f44336'], // Цвета столбцов
                    borderColor: ['#4caf50', '#f44336'],    // Цвета границ столбцов
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <a href="index.php">Пройти тест заново</a>
</body>
</html>
