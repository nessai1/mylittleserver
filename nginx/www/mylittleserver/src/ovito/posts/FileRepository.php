<?php

namespace Ovito\Posts;

use Core\Storage\FileStorage\Storage;
use Core\Storage\Model;
use Core\Storage\Repository;

final class FileRepository extends Repository
{
	public const SECTION_ID = 'posts';
	private Storage $storage;

	public function getList(int $length, int $offset = 0): array
	{
		return array_slice($this->getModels(), $offset, $length);
	}

	private function getModels(): array
	{
		if (!$this->models)
		{
			$this->fillModels();
		}

		return $this->models;
	}

	private function fillModels(): void
	{

	}

	public function createModel(array $data): PostModel
	{
		if (!isset($data['ID']))
		{
			$data['ID'] = md5(date('mdyGis'));
		}

		return (new PostModel($this))->setData($data);
	}

	public function saveModel(Model $model)
	{
		if ($model->getId() === null) // TODO: need to exception
		{
			return;
		}


	}



	public function __construct()
	{
		$this->storage = new Storage(self::SECTION_ID);
	}

	public function getModelsByQuery(array $queryParams): array
	{
		// TODO: Implement getModelsByQuery() method.
		return [];
	}
}