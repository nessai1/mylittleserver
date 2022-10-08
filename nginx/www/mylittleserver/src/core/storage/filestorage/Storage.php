<?php

namespace Core\Storage\FileStorage;

use Core\Log\Logger;
use Core\Log\LoggerAware;
use DirectoryIterator;
use SplFileInfo;

final class Storage extends Section
{
	private string $storageId;

	protected string $classContext = \Core\Storage\FileStorage\File\File::class;
	private static Logger $logger;

	private static function getLogger()
	{
		if (!isset(self::$logger))
		{
			self::$logger = LoggerAware::getLogger();
		}

		return self::$logger;
	}

	/**
	 * @throws StorageException
	 */
	public function __construct(string $storageId)
	{
		if (!$storageId)
		{
			throw new StorageException("Invalid empty string in storage name");
		}

		try
		{
			$this->storageId = $storageId;
			parent::__construct(new DirectoryIterator(self::getPathToStorage($storageId)), $this->classContext);
		}
		catch (\UnexpectedValueException $e)
		{
			throw new StorageDoesNotExists("Storage does not exist");
		}
		catch (\Exception $e)
		{
			throw new StorageException("Unhandled exception appear: {$e->getMessage()}");
		}
	}

	/**
	 * @throws StorageException
	 */
	public function setContext(string $classname): self
	{
		if (!self::isImplementFileClass($classname))
		{
			throw new StorageException("Class {$classname} is not implement File class");
		}

		$this->classContext = $classname;

		return $this;
	}

	public static function isImplementFileClass(string $classname): bool
	{
		return in_array(\Core\Storage\FileStorage\File\File::class, class_parents($classname), true);
	}

	private static function getPathToStorage($storageId): string
	{
		return $_SERVER['DOCUMENT_ROOT'] . "/../data/{$storageId}";
	}

	/**
	 * @throws StorageException
	 */
	public static function createStorage($storageId): Storage
	{
		$storagePath = self::getPathToStorage($storageId);
		if (!file_exists($storagePath) && !mkdir($storagePath) && !is_dir($storagePath))
		{
			throw new StorageDoesNotExists($storageId);
		}

		return new Storage($storageId);
	}

	/**
	 * @throws StorageException
	 */
	public static function getStorage(string $storageId): Storage
	{
		return new Storage($storageId);
	}

	public static function isStorageExists($storageId): bool
	{
		return is_dir(self::getPathToStorage($storageId));
	}
}