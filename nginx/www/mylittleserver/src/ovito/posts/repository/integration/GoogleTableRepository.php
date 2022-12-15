<?php

namespace WebLab\Ovito\Posts\Repository\Integration;

use WebLab\Core\Storage\Repository\Model;
use WebLab\Ovito\Posts\Repository\PostsRepository;

final class GoogleTableRepository implements PostsRepository
{

	public function getAvailableCategories(): array
	{
		// TODO: Implement getAvailableCategories() method.
	}

	public function getList(mixed $length = null, int $offset = 0): array
	{
		// TODO: Implement getList() method.
	}

	public function saveModel(Model $model): void
	{
		// TODO: Implement saveModel() method.
	}

	public function createModel(array $data = []): Model
	{
		// TODO: Implement createModel() method.
	}
}