<?php

namespace Ovito\Views;

use Core\Storage\Repository\Repository;
use Core\View\View;
use Core\View\ViewInterface;
use Ovito\Posts\Repository\PostsRepository;

class DashboardView implements ViewInterface
{
	private Repository $repository;
	private string $responseHandlerPath;

	public function __construct(PostsRepository $repository, string $responseHandlerPath = '.')
	{
		$this->repository = $repository;
		$this->responseHandlerPath = $responseHandlerPath;
	}

	public function getContent(): string
	{
		return (new View('ovito', [
			'posts' => $this->repository->getList(),
			'postsRepository' => $this->repository,
			'responseHandlerPath' => $this->responseHandlerPath,
		]))->getContent();
	}
}