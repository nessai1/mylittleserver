<?php

namespace WebLab\Core\Storage\Repository;

class InvalidModelStructure extends ModelException
{
	private string $classname;

	public function __construct(string $classname)
	{
		parent::__construct("Model {$classname} does not have required elements");
		$this->classname = $classname;
	}

	public function getClassname(): string
	{
		return $this->classname;
	}
}