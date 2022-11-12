<?php

namespace Core;

use Core\Log\LoggerAware;

class CoreError extends \Error
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
			$message = static::$prefix . ': Undefined error. Exception message is empty';
		}
		parent::__construct($message);

		LoggerAware::getLogger()->critical($message);
	}
}