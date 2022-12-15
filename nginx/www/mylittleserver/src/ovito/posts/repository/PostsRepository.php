<?php

namespace WebLab\Ovito\Posts\Repository;

interface PostsRepository extends \WebLab\Core\Storage\Repository\Repository
{
	public function getAvailableCategories(): array;
}