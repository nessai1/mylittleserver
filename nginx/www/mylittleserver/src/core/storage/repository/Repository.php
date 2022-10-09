<?php

namespace Core\Storage\Repository;

abstract class Repository
{
	/**
	 * Returns array of <b>Core\Storage\Model</b>
	 * @param int $len
	 * @param int $offset
	 * @return array <b>Core\Storage\Model</b> array
	 */
	abstract public function getList(int $length, int $offset = 0): array;

	abstract public function saveModel(Model $model);

	abstract public function createModel(array $data = []): Model;
}