<?php

namespace Core\Rest\Handler;

use Core\Rest\Response\Response;
use Core\Rest\Response\ResponseType;
use JsonException;

abstract class RestHandler
{
	abstract protected function getDepthLimit(): int;

	abstract protected function handleRequest(array $body): Response;

	public function listen(): void
	{
		header('Content-Type: application/json; charset=utf-8');

		try {
			$body = json_decode(file_get_contents('php://input'), true, $this->getDepthLimit(), JSON_THROW_ON_ERROR);
		} catch (JsonException $e) {
			echo new Response(ResponseType::BAD_REQUEST);
			die();
		}

		echo $this->handleRequest($body);
	}
}