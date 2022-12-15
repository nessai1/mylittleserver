<?php

namespace WebLab\Core\Storage\Repository;

interface Repository
{
	/**
	 * Returns array of <b>Core\Storage\Model</b>
	 * @param int $len
	 * @param int $offset
	 * @return array <b>Core\Storage\Model</b> array
	 */
	public function getList(mixed $length = null, int $offset = 0): array;

	/**
	 * Save model in specific way for repository
	 * ex: save in file, save in database, etc.
	 * @param Model $model
	 */
	public function saveModel(Model $model): void;

	public function createModel(array $data = []): Model;
}