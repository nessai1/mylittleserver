<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Лаба 2: Задание 1</title>
</head>
<body>
<div class="mt-6 ml-10">
	<div>
		<header>
			<span class="text-3xl font-bold">A. Найти строчку по регулярке</span>
		</header>
		<form class="mt-4" id="one">
			<input name="val" id="one_inp" type="text" class="p-2 rounded-lg border-solid border-2 border-slate-500 mr-3" placeholder="вводи давай" />
			<button type="submit" class=" bg-blue-600 text-white py-2 px-4 rounded-lg active:bg-blue-800">обработать</button>
		</form>
		<div id="first_results" class="mt-4">
		</div>
	</div>

	<div class="mt-12">
		<header>
			<span class="text-3xl font-bold">Б. Возвести числа в куб</span>
		</header>
		<form class="mt-4" id="two">
			<input name="val" id="two_inp" type="text" class="p-2 rounded-lg border-solid border-2 border-slate-500" placeholder="вводи давай" />
			<button type="submit" class="ml-3 bg-blue-600 text-white py-2 px-4 rounded-lg active:bg-blue-800">обработать</button>
		</form>
		<div id="second_results" class="mt-4">
		</div>
	</div>

</div>

<script>
	function addFirst(result)
	{
		let matchesBlock = '<p>Ничего не найдено</p>';
		if (result.matches?.length > 0)
		{
			matchesBlock = '<ul class="list-disc ml-5">';
			result.matches.forEach(el => {
				matchesBlock += `<li>${el}</li>`;
			});
			matchesBlock += '</ul>';
		}

		const oldResult = document.querySelector('#first_results').innerHTML;

		document.querySelector('#first_results').innerHTML =
			`
				<div class="mb-3">
					<div class="p-5 rounded-md border-2 border-black-100 w-1/4">
						<span class="font-bold"> Ввод: </span>
						<span class="break-all">${result.input}</span>
						<span class="font-bold block py-3">Результат</span>
						${matchesBlock}
					</div>
				</div>
			`
		+ oldResult
		;
	}

	function addSecond(result)
	{
		const oldResult = document.querySelector('#second_results').innerHTML;

		document.querySelector('#second_results').innerHTML =
			`
				<div class="p-5 rounded-md border-2 border-black-100 w-1/4">
					<span class="font-bold"> Ввод: </span>
					<span class="break-all">${result.input}</span>
					<br>
					<span class="font-bold py-3">Результат: </span>
					<span class="break-all">${result.result}</span>
				</div>
			`
			+ oldResult
		;
	}


	document.querySelector('#one').onsubmit = (e) => {
		e.preventDefault();
		const form = new FormData(document.querySelector('#one'));
		const reg = form.get('val');
		if (reg)
		{
			document.querySelector('#one_inp').value = '';
			fetch('/l2/t1/first.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({text: reg})
			}).then((res) => {
				res.json().then((res) => {
					if (res.code === 'OK')
					{
						addFirst(res.data);
					}
				})
			});
		}
	}

	document.querySelector('#two').onsubmit = (e) => {
		e.preventDefault();
		const form = new FormData(document.querySelector('#two'));
		const reg = form.get('val');
		if (reg)
		{
			document.querySelector('#one_inp').value = '';
			fetch('/l2/t1/second.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({text: reg})
			}).then((res) => {
				res.json().then((res) => {
					if (res.code === 'OK')
					{
						addSecond(res.data);
					}
				})
			});
		}
	}
</script>

</body>
</html>