<?php

namespace WebLab\Core;

class ApplicationError extends \WebLab\Core\CoreError
{
	protected static string $prefix = '[APPLICATION ERROR]';

	public function __construct(string $message, int $code = 0, \Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}