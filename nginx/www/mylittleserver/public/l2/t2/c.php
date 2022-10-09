<?php
session_start();

if (isset($_POST['firstname'], $_POST['secondname'], $_POST['age'], $_POST['something'], $_POST['money']) && is_numeric($_POST['age']) && is_numeric($_POST['money']))
{
	$_SESSION['C_USER'] = [
		'FIRSTNAME' => $_POST['firstname'],
		'SECONDNAME' => $_POST['secondname'],
		'AGE' => $_POST['age'],
		'MONEY' => $_POST['money'],
		'SOMETHING' => $_POST['something'],
	];
	$saved = true;
}
else
{
	$saved = false;
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 2-c</title>
</head>
<body class="p-5">
<header class="font-bold text-3xl mb-5">С. Сессия. Часть 1</header>
<?php if ($saved): ?>
	<div class="bg-green-200 p-3 rounded-lg mb-3">
		Данные сохранены!
	</div>
<?php endif; ?>
<form action="c.php" method="post" class="mb-3">
	<input name="firstname" placeholder="Имя" class="block p-3 rounded-lg border-2 border-slate-500 mb-3" />
	<input name="secondname" placeholder="Фамилия" class="block p-3 rounded-lg border-2 border-slate-500 mb-3" />
	<input name="age" placeholder="Возраст" class="block p-3 rounded-lg border-2 border-slate-500 mb-3" />
	<input name="money" placeholder="Сколько. Ты. Зарабатываешь?" class="block p-3 rounded-lg border-2 border-slate-500 mb-3" />
	<input name="something" placeholder="Что-нибудь еще" class="block p-3 rounded-lg border-2 border-slate-500 mb-3" />
	<button class="rounded-lg bg-sky-600 text-white p-2 active:bg-sky-700">Сохранить данные</button>
</form>
<a href="/l2/t2/cc.php" class="text-sky-500">Инфа о сессии</a>
</body>
</html>