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

$inputText = $body['text'] ?? '';



die();