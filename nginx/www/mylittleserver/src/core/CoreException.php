<?php

namespace Core;

use Core\Log\LoggerAware;

class CoreException extends \Exception
{
	protected static string $prefix = "[CORE ERROR]";

	public function __construct(string $message = "")
	{
		if ($message)
		{
			$message = static::$prefix . ': ' . $message;
		}
		else
		{
			$message = static::$prefix . ': Undefined error';
		}
		parent::__construct($message);

		LoggerAware::getLogger()->alert($message);
	}
}