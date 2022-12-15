<?php

namespace WebLab\Core\Storage\FileStorage;

use WebLab\Core\CoreException;

class StorageException extends CoreException
{
	protected static string $prefix = '[STORAGE EXCEPTION]';

	public function __construct(string $message = "")
	{
		parent::__construct($message);
	}
}