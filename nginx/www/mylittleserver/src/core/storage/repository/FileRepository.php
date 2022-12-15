<?php

namespace WebLab\Core\Storage\Repository;

use WebLab\Core\Storage\FileStorage\File\JSONFile;
use WebLab\Core\Storage\FileStorage\Storage;

abstract class FileRepository implements Repository
{
	protected Storage $storage;

	/**
	 * @throws \Core\Storage\FileStorage\StorageException
	 */
	public function __construct()
	{
		$this->storage = (new Storage(static::getStorageId()))->setContext(JSONFile::class);
	}

	/**
	 * Save model data to JSON file
	 * @param Model $model
	 * @return void
	 * @throws \Core\Storage\FileStorage\SectionException
	 */
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

	/**
	 * Fetch specific group ID for model to store it in eponymous <b>section</b>
	 * @param Model $model
	 * @return string
	 */
	abstract protected static function fetchGroupId(Model $model): string;

	/**
	 * Fetch specific model name for model to store it in eponymous <b>file</b>
	 * @param Model $model
	 * @return string
	 */
	abstract protected static function fetchModelName(Model $model): string;

	/**
	 * Get storage ID that contains models
	 * @return string
	 */
	abstract public static function getStorageId(): string;
}