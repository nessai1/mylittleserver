<?php

namespace WebLab\Ovito\Posts\Repository;

use WebLab\Core\Storage\DatabaseStorage\Database;
use WebLab\Core\Storage\FileStorage\SectionException;
use WebLab\Core\Storage\Repository\Model;
use WebLab\Ovito\Posts\PostModel;

class DatabaseRepository implements PostsRepository
{
	protected array $models;
	protected Database $database;

	public function __construct()
	{
		$this->database = Database::getDatabase();
	}

	public function getList(mixed $length = null, int $offset = 0): array
	{
		if (!isset($this->models))
		{
			$this->models = $this->database->query('SELECT * FROM ad');

			array_walk($this->models, function (&$model) {
				$model = $this->createModel([
					'title' => $model['TITLE'],
					'text' => $model['DESCRIPTION'],
					'category' => $this->getCategoryNameById($model['CATEGORY_ID']),
					'email' => $model['EMAIL'],
				]);
			});
		}

		return array_splice($this->models, $offset, $length);
	}

	public function getCategoryIdByName(string $name): int
	{
		$category = $this->database->query('SELECT * FROM category WHERE NAME = ?', [$name]);
		return $category[0]['ID'];
	}

	public function getCategoryNameById(int $id): string
	{
		$category = $this->database->query('SELECT * FROM category WHERE ID = ?', [$id]);
		return $category[0]['NAME'];
	}

	public function saveModel(Model $model): void
	{
		$this->database->execute('INSERT INTO ad (TITLE, DESCRIPTION, CATEGORY_ID, EMAIL) VALUES (?, ?, ?, ?)', [
			$model['title'],
			$model['text'],
			$this->getCategoryIdByName($model['category']),
			$model['email'],
		]);
	}

	public function createModel(array $data = []): Model
	{
		return (new PostModel($this))->setData($data);
	}

	public function getAvailableCategories(): array
	{
		return array_column($this->database->query('SELECT DISTINCT name FROM category'), 'name');
	}
}