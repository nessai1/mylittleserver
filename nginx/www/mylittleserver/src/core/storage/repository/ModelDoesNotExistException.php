<?php

namespace Core\Storage\Repository;

use Core\CoreException;
use Exception;

class ModelDoesNotExistException extends ModelException
{
	private string $classname;

	public function __construct(string $classname)
	{
		parent::__construct("Classname {$classname} does not exist or not implementing Storage\\Model interface");
		$this->classname = $classname;
	}

	public function getClassname(): string
	{
		return $this->classname;
	}
}