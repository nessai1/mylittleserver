<?php

namespace Ovito\Posts\Repository;

use Core\Storage\Repository\Model;
use Ovito\Posts\PostModel;

class FileRepository extends \Core\Storage\Repository\FileRepository
{
	protected array $models;

	protected static function fetchGroupId(Model $model): string
	{
		return $model->getData()['category'];
	}

	protected static function fetchModelName(Model $model): string
	{
		return $model->getData()['title'] . '.txt';
	}

	public static function getStorageId(): string
	{
		return 'posts';
	}

	public function getList(int $length, int $offset = 0): array
	{
		$this->models ??= $this->fetchPostsList();
		return $this->models;
	}

	protected function fetchPostsList(): array
	{
		$posts = [];
		foreach ($this->storage->getSectionList() as $section)
		{
			foreach ($section->getFiles() as $file)
			{
				$posts[] = $this->createModel($file->getJsonData());
			}
		}
		return $posts;
	}

	public function createModel(array $data = []): Model
	{
		return (new PostModel($this))->setData($data);
	}
}