<?php

use Ovito\Posts\PostModel;
use Ovito\Posts\Repository\FileRepository;

require_once '../../../src/autoload.php';

$postsRepository = new FileRepository();
$posts = $postsRepository->getList();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 3</title>
</head>
<body>
<style>
	@keyframes add-post {
		0% {
			opacity: 0;
			transform: translateY(-10px);
		}
		100% {
			opacity: 1;
			transform: translateY(0);
		}
	}
</style>
<header class="py-4 px-5 bg-cyan-800"><span class="text-white tracking-wider text-2xl font-bold">Овито</span></header>
<div class="m-5">
	<span class="text-xl font-bold my-3 block">Опубликовать объявление</span>
	<form action="#" id="form">
		<div class="flex flex-col">
			<label for="title" class="mb-2">Заголовок</label>
			<input type="text" name="title" id="title" class="border-2 border-gray-300 p-2 rounded-lg">
		</div>
		<div class="flex flex-col mt-3">
			<label for="text" class="mb-2">Текст</label>
			<textarea name="text" id="text" class="border-2 border-gray-300 p-2 rounded-lg"></textarea>
		</div>
		<div class="flex flex-col mt-3">
			<label for="category" class="mb-2">Категория</label>
			<select name="category" id="category" class="border-2 border-gray-300 p-2 rounded-lg">
				<?php foreach ($postsRepository->getAvailableCategories() as $category): ?>
					<option value="<?= $category ?>"><?= $category ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="flex flex-col mt-3">
			<label for="email" class="mb-2">Email</label>
			<input type="email" name="email" id="email" class="border-2 border-gray-300 p-2 rounded-lg">
		</div>
		<button class="bg-cyan-800 text-white p-2 rounded-lg mt-3">Опубликовать</button>
	</form>

	<span class="text-xl font-bold my-3 block">Опубликованые объявления</span>
	<table class="table-auto border border-slate-400 w-full">
		<thead class="bg-slate-200">
		<tr>
			<th class="font-semibold p-4 text-slate-900 text-left">Объявление</th>
			<th class="font-semibold p-4 text-slate-900 text-left">Категория</th>
			<th class="font-semibold p-4 text-slate-900 text-left">Email</th>
		</tr>
		</thead>
		<tbody id="table-body">
		<?php
		/** @var PostModel $post */
		foreach ($posts as $post): echo
<<<ITEM
		<tr>
			<td class="p-3">
				<span class="font-bold text-lg">{$post->getCleanTitle()}</span>
				<p class="text-base">{$post->getCleanText()}</p>
			</td>
			<td class="p-3">{$post->getCleanCategory()}</td>
			<td class="p-3">{$post->getCleanEmail()}</td>
		</tr>
ITEM;
		endforeach;
		?>
		</tbody>
	</table>
</div>

<script>
	const form = document.getElementById('form');
	const tableBody = document.getElementById('table-body');

	form.addEventListener('submit', (e) => {
		e.preventDefault();

		const formData = new FormData(form);
		const data = Object.fromEntries(formData.entries());
		form.querySelectorAll('input, textarea').forEach((input) => {
			input.value = '';
		});
		fetch('createPost.php', {
			method: 'POST',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		}).then((response) => {
				if (response.ok) {
					return response.json();
				}
			}).then((responseBody) => {
				if (responseBody.code !== 'OK')
				{
					return;
				}

				const data = responseBody.data.post;
				const row = document.createElement('tr');
				row.style.animation = 'add-post 0.5s ease-in-out';
				row.innerHTML = `
					<td class="p-3">
						<span class="font-bold text-lg">${data.title}</span>
						<p class="text-base">${data.text}</p>
					</td>
					<td class="p-3">${data.category}</td>
					<td class="p-3">${data.email}</td>
				`;
				tableBody.insertBefore(row, tableBody.firstChild);
			});
	});
</script>
</body>
</html>