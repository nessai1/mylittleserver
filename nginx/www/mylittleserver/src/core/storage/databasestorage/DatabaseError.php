<?php

namespace Core\Storage\DatabaseStorage;

class DatabaseError extends \Core\CoreError
{
	protected static string $prefix = '[DATABASE ERROR]';

	public function __construct(string $message, int $code = 0, \Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}