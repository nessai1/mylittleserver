<?php

namespace Ovito\Views;

use Core\Storage\Repository\Repository;
use Core\View\View;

class DashboardView
{
	private Repository $repository;

	public function __construct(Repository $repository)
	{
		$this->repository = $repository;
	}

	public function render(): string
	{
		return (new View('ovito', [
			'posts' => $this->repository->getList(),
			'postsRepository' => $this->repository,
		]))->getContent();
	}
}