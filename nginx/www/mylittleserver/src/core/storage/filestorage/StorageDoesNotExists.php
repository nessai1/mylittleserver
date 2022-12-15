<?php

namespace WebLab\Core\Storage\FileStorage;

class StorageDoesNotExists extends StorageException
{
	public function __construct(string $storageId)
	{
		parent::__construct("Storage {$storageId} does not exists");
	}
}