<?php

require_once '../../../src/autoload.php';
header('Content-Type: application/json; charset=utf-8');

use Core\Rest\Response\Response;
use Core\Rest\Response\ResponseType;
use Ovito\Posts\PostModel;
use Ovito\Posts\Repository\FileRepository;

try {
	$body = json_decode(file_get_contents('php://input'), true, 2, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

if (!isset($body['title'], $body['text'], $body['category'], $body['email']))
{
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

$postsRepository = new FileRepository();
$model = $postsRepository->createModel([
	'title' => $body['title'],
	'text' => $body['text'],
	'category' => $body['category'],
	'email' => $body['email'],
]);

try
{
	$model->save();
}
catch (\Core\Storage\Repository\InvalidModelStructure $e)
{
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

echo new Response(ResponseType::OK, [
	'post' => [
		'title' => $model->getCleanTitle(),
		'text' => $model->getCleanText(),
		'category' => $model->getCleanCategory(),
		'email' => $model->getCleanEmail(),
	],
]);

die();