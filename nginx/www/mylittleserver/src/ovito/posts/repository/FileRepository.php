<?php

namespace Ovito\Posts\Repository;

use Core\Storage\FileStorage\SectionException;
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
		return md5($model->getData()['title']) . '.txt';
	}

	public static function getStorageId(): string
	{
		return 'posts';
	}

	/**
	 * @throws SectionException
	 */
	public function getList(mixed $length = null, int $offset = 0): array
	{
		$this->models ??= $this->fetchPostsList();
		return array_splice($this->models, $offset, $length);
	}

	/**
	 * Fetch posts list from storage
	 * @return array
	 * @throws SectionException
	 */
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

	/**
	 * Create model from data
	 * @param array $data
	 * @return Model
	 */
	public function createModel(array $data = []): Model
	{
		return (new PostModel($this))->setData($data);
	}

	/**
	 * Return list of available categories in storage
	 * @return array
	 * @throws SectionException
	 */
	public function getAvailableCategories(): array
	{
		return array_keys($this->storage->getSectionList());
	}
}