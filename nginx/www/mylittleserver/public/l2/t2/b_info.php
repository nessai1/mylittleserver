<?php

session_start();
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 2-b - Инфо о сессии</title>
</head>
<body class="p-5">
<header class="font-bold text-3xl mb-5">Б. Сессия. Часть 2</header>
<?php if (isset($_SESSION['B_FIRSTNAME'], $_SESSION['B_SECONDNAME'], $_SESSION['B_AGE'])): ?>
	<div>
		<span class="block">Имя: <?=$_SESSION['B_FIRSTNAME']?></span>
		<span class="block">Фамилия: <?=$_SESSION['B_SECONDNAME']?></span>
		<span class="block">Возраст: <?=$_SESSION['B_AGE']?></span>
	</div>
<?php else: ?>
	<div>
		<span>Данные еще не сохранены</span>
	</div>
<?php endif; ?>
</body>
</html>