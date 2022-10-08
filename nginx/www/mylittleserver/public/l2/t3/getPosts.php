<?php

require_once '../../../src/autoload.php';
header('Content-Type: application/json; charset=utf-8');

use Core\Rest\Response\Response;
use Core\Rest\Response\ResponseType;
use Ovito\Posts\FileRepository;
use Ovito\Posts\PostModel;

function getPreparedPosts($models): array
{
	$posts = [];

	/** @var PostModel $model */
	foreach ($models as $model)
	{
		$posts[] = $model->getData();
	}

	return $posts;
}

try {
	$body = json_decode(file_get_contents('php://input'), true, 2, JSON_THROW_ON_ERROR);
} catch (JsonException $e) {
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}

if (!isset($body['length']))
{
	echo new Response(ResponseType::BAD_REQUEST);
	die();
}
$length = (int)$body['length'];
$offset = (int)($body['offset'] ?? 0);

echo new Response(ResponseType::OK, [
	'posts' => getPreparedPosts((new FileRepository())->getList($length, $offset)),
]);

die();