<?php

namespace WebLab\Ovito\Posts\Repository\Integration;

use WebLab\Core\Storage\Repository\Model;
use WebLab\Integration\GoogleSheets;
use WebLab\Ovito\Posts\PostModel;
use WebLab\Ovito\Posts\Repository\PostsRepository;

final class GoogleTableRepository implements PostsRepository
{
	private const SHEET_ID = '1gxMDuufb8zGIJm-jXosFuIS2C5sOfqQ5kmVOieLOAMQ';
	public function getAvailableCategories(): array
	{
		return array_column(GoogleSheets::getWorkSheets(self::SHEET_ID, 'C2:C'), 0);
	}

	public function getList(mixed $length = null, int $offset = 0): array
	{
		$posts = GoogleSheets::getWorkSheets(self::SHEET_ID, 'A2:F');
		return array_map(function ($post) {
			return (new PostModel($this))->setData([
				'title' => $post[0],
				'text' => $post[1],
				'category' => $post[2],
				'email' => $post[3],
				'created_at' => $post[4],
			]);
		}, $posts);
	}

	public function saveModel(Model $model): void
	{
		GoogleSheets::appendWorkSheets(self::SHEET_ID, 'A:E', [
			$model->getCleanTitle(),
			$model->getCleanText(),
			$model->getCleanCategory(),
			$model->getCleanEmail(),
			date('Y.m.d'),
		]);
	}

	public function createModel(array $data = []): Model
	{
		return (new PostModel($this))->setData($data);
	}
}