<?php

namespace WebLab\Core\Storage\DatabaseStorage;

class DatabaseError extends \WebLab\Core\CoreError
{
	protected static string $prefix = '[DATABASE ERROR]';

	public function __construct(string $message, int $code = 0, \Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}