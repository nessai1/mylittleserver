<?php

namespace Ovito\Posts\Repository;

interface PostsRepository extends \Core\Storage\Repository\Repository
{
	public function getAvailableCategories(): array;
}