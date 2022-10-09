<?php

session_start();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 2-c - Инфо о сессии</title>
</head>
<body class="p-5">
<header class="font-bold text-3xl mb-5">C. Сессия. Часть 2</header>
<?php if (isset($_SESSION['C_USER'])): ?>
	<ul>
		<?php foreach ($_SESSION['C_USER'] as $key => $value): ?>
			<li><?=$key?>: <?=$value?></li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<div>
		<span>Данные еще не сохранены</span>
	</div>
<?php endif; ?>
</body>
</html>