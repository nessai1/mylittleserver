<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 2-a</title>
</head>
<body class="p-5">
<header class="font-bold text-3xl mb-5">A. Посчитать количество текста в тексте</header>
<form action="a.php" method="post" class="mb-3">
	<textarea name="text" placeholder="сюда вводить!" class="block p-3 rounded-lg border-2 border-slate-500 mb-3"></textarea>
	<button class="rounded-lg bg-sky-600 text-white p-2 active:bg-sky-700">Посчитать циферки!</button>
</form>
<?php
if (isset($_POST['text']) && is_string($_POST['text']))
{
	echo "Введеное слово: " . $_POST['text'];
	echo "<br>";
	echo "Количество буковок: " . mb_strlen($_POST['text']);
	echo "<br>";
	echo "Количество слов: " . str_word_count($_POST['text'], 0);
}
?>
</body>
</html>