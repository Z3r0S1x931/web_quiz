<?php
session_start();

// Загрузка вопросов
$questions = include 'questions.php';

// Выбираем случайные 5 вопросов
shuffle($questions); // Перемешиваем массив $questions
$random_questions = array_slice($questions, 0, 5); // Берём первые 5 вопросов


// Сохраняем вопросы в сессию
$_SESSION['questions'] = $random_questions;
$_SESSION['current_question'] = 0;
$_SESSION['score'] = 0;

header('Location: question.php');
exit();
?>
