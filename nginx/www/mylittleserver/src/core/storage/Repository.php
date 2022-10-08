<?php

namespace Core\Storage;

abstract class Repository
{

	protected array $models;

	/**
	 * Returns array of <b>Core\Storage\Model</b>
	 * @param int $len
	 * @param int $offset
	 * @return array <b>Core\Storage\Model</b> array
	 */
	abstract public function getList(int $length, int $offset = 0): array;

	/**
	 * Returns array of <b>Core\Storage\Model</b>
	 * @param array $queryParams
	 * @return array <b>Core\Storage\Model</b> array
	 */
	abstract public function getModelsByQuery(array $queryParams): array;

	abstract public function saveModel(Model $model);

	abstract public function createModel(array $data): Model;
}