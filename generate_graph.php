<?php
// Получаем данные из URL-параметров
$correct = isset($_GET['correct']) ? (int)$_GET['correct'] : 0;
$errors = isset($_GET['errors']) ? (int)$_GET['errors'] : 0;

// Создаём изображение
$img_width = 400;
$img_height = 300;
$image = imagecreate($img_width, $img_height);

// Цвета
$background_color = imagecolorallocate($image, 255, 255, 255); // Белый фон
$bar_color = imagecolorallocate($image, 100, 150, 255); // Синий цвет для баров
$font_color = imagecolorallocate($image, 0, 0, 0); // Черный для текста

// Рисуем графики
$bar_width = 100;

// Правильные ответы
$correct_height = $correct * 30; // Каждый правильный ответ дает 30px высоты
imagefilledrectangle($image, 50, $img_height - $correct_height - 10, 150, $img_height - 10, $bar_color);

// Ошибки
$errors_height = $errors * 30; // Каждый ошибочный ответ дает 30px высоты
imagefilledrectangle($image, 200, $img_height - $errors_height - 10, 300, $img_height - 10, $bar_color);

// Подписи
imagestring($image, 5, 70, $img_height - 220, "Правильно", $font_color);
imagestring($image, 5, 220, $img_height - 220, "Ошибки", $font_color);

// Вывод изображения
header("Content-Type: image/png");
imagepng($image);

// Освобождение памяти
imagedestroy($image);
?>
