<?php

namespace WebLab\Ovito\Views;

use WebLab\Core\Storage\Repository\Repository;
use WebLab\Core\View\View;
use WebLab\Core\View\ViewInterface;
use WebLab\Ovito\Posts\Repository\PostsRepository;

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