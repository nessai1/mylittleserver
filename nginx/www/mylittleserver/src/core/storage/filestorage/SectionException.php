<?php

namespace Core\Storage\FileStorage;

use Core\CoreException;

class SectionException extends CoreException
{
	protected static string $prefix = '[SECTION ERROR]';

	public function __construct(string $message = "")
	{
		parent::__construct($message);
	}
}