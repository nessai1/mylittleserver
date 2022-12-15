<?php

namespace WebLab\Core\Storage\FileStorage;

use WebLab\Core\CoreException;

class SectionException extends CoreException
{
	protected static string $prefix = '[SECTION EXCEPTION]';

	public function __construct(string $message = "")
	{
		parent::__construct($message);
	}
}