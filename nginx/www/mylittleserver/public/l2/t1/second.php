<?php

require_once '../../../src/autoload.php';
header('Content-Type: application/json; charset=utf-8');

use Core\Rest\Response\Response;
use Core\Rest\Response\ResponseType;

try {
	$body = json_decode(file_get_contents('php://input'), true, 2, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

if (empty($inputText = $body['text'] ?? ''))
{
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

preg_match_all('/\d*/', $inputText, $numbers);
$numbers = array_filter($numbers[0], static fn($number) => $number !== '');

preg_match_all('/\D*/', $inputText, $otherSymbols);
$otherSymbols = array_filter($otherSymbols[0], static fn($symbol) => $symbol !== '');
$otherSymbols = array_map(static fn($symbol) => trim(htmlspecialchars($symbol)), $otherSymbols);

$resultString = '';
$count = max(count($numbers), count($otherSymbols));
if (preg_match('/\d/', $inputText[0]))
{
	for ($i = 0; $i < $count; $i++)
	{
		$number = array_shift($numbers);
		if ($number !== null)
		{
			$resultString .= $number ** 3;
		}
		$resultString .= array_shift($otherSymbols) ?? '';
	}
}
else
{
	for ($i = 0; $i < $count; $i++)
	{
		$resultString .= array_shift($otherSymbols) ?? '';
		$number = array_shift($numbers);
		if ($number !== null)
		{
			$resultString .= $number ** 3;
		}
	}
}

echo new Response(ResponseType::OK, [
	'input' => trim(htmlspecialchars($inputText)),
	'result' => $resultString,
]);

die();