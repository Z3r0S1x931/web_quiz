<?php
session_start();

$current_question = $_SESSION['current_question'];
$questions = $_SESSION['questions'];

if ($current_question >= count($questions)) {
    header('Location: results.php');
    exit();
}

$question = $questions[$current_question];
// Перемешиваем ответы
$answers = $question['answers']; // Берём массив ответов из текущего вопроса
shuffle($answers);               // Перемешиваем массив

// Получаем 4 случайных ответа
$answers = array_slice($answers, 0, 5);
 // Случайные 4 ответа

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_answer = $_POST['answer'];

    // Проверяем правильность ответа
    foreach ($question['answers'] as $answer) {
        if ($answer['value'] === $selected_answer && $answer['correct'] === true) {
            $_SESSION['score'] += 1;
        }
    }

    $_SESSION['current_question']++;
    header('Location: question.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вопрос <?= $current_question + 1 ?></title>
</head>
<body>
    <h1>Вопрос <?= $current_question + 1 ?></h1>
    <form method="POST">
        <p><?= $question['question'] ?></p>
        <?php foreach ($answers as $answer): ?>
            <label>
                <input type="radio" name="answer" value="<?= $answer['value'] ?>" required>
                <?= $answer['value'] ?>
            </label><br>
        <?php endforeach; ?>
        <button type="submit">Ответить</button>
    </form>
</body>
</html>
