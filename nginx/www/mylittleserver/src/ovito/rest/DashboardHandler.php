<?php

namespace Ovito\Rest;

use Core\Rest\Handler\RestHandler;
use Core\Rest\Response\Response;
use Core\Rest\Response\ResponseType;
use Core\Storage\Repository\InvalidModelStructure;
use Core\Storage\Repository\Repository;
use Ovito\Posts\PostModel;

class DashboardHandler extends RestHandler
{
	private Repository $repository;

	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	public function getDepthLimit(): int
	{
		return 2;
	}

	public function handleRequest(array $body): Response
	{
		return match ($body['action']) {
			'createPost' => $this->createPost($body),
			'getPosts' => $this->getPosts($body),
			default => new Response(ResponseType::BAD_REQUEST),
		};

	}

	private function createPost(array $body): Response
	{
		$model = $this->repository->createModel([
			'title' => $body['title'],
			'text' => $body['text'],
			'category' => $body['category'],
			'email' => $body['email'],
		]);

		try
		{
			$model->save();
		}
		catch (InvalidModelStructure $e)
		{
			return new Response(ResponseType::BAD_REQUEST);
		}

		return new Response(ResponseType::OK, [
			'post' => [
				'title' => $model->getCleanTitle(),
				'text' => $model->getCleanText(),
				'category' => $model->getCleanCategory(),
				'email' => $model->getCleanEmail(),
			],
		]);
	}

	private function getPosts(array $body): Response
	{

		if (!isset($body['length']))
		{
			return new Response(ResponseType::BAD_REQUEST);
		}
		$length = (int)$body['length'];
		$offset = (int)($body['offset'] ?? 0);

		$posts = $this->repository->getList($length, $offset);

		return new Response(ResponseType::OK, [
			'posts' => static::getPreparedPosts($posts),
		]);
	}

	protected static function getPreparedPosts(array $models): array
	{
		$posts = [];

		/** @var PostModel $model */
		foreach ($models as $model)
		{
			$posts[] = $model->getData();
		}

		return $posts;
	}
}