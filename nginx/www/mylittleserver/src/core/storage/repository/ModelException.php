<?php

namespace WebLab\Core\Storage\Repository;

use WebLab\Core\CoreException;

class ModelException extends CoreException
{
	protected static string $prefix = '[MODEL EXCEPTION]';

	public function __construct(string $message)
	{
		parent::__construct($message);
	}
}