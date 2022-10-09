<?php

namespace Core\Storage\Repository;

use Core\Storage\FileStorage\File\JSONFile;
use Core\Storage\FileStorage\Storage;

abstract class FileRepository extends Repository
{
	protected Storage $storage;

	/**
	 * @throws \Core\Storage\FileStorage\StorageException
	 */
	public function __construct()
	{
		$this->storage = (new Storage(static::getStorageId()))->setContext(JSONFile::class);
	}

	public function saveModel(Model $model): void
	{
		$groupId = static::fetchGroupId($model);
		if (!$this->storage->isSectionExists($groupId))
		{
			$this->storage->createSection($groupId);
		}
		$groupSection = $this->storage->getSection($groupId);

		$modelName = static::fetchModelName($model);
		if (!$groupSection->isFileExists($modelName))
		{
			$file = $groupSection->createFile($modelName);
		}
		else
		{
			$file = $groupSection->getFile($modelName);
		}

		$file->setJsonData($model->getData());
		$file->save();
	}

	abstract protected static function fetchGroupId(Model $model): string;
	abstract protected static function fetchModelName(Model $model): string;
	abstract public static function getStorageId(): string;
}