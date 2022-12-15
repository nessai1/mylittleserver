<?php

namespace WebLab\Core;

use WebLab\Core\Log\LoggerAware;

class CoreException extends \Exception
{
	protected static string $prefix = "[CORE EXCEPTION]";

	public function __construct(string $message = "")
	{
		if ($message)
		{
			$message = static::$prefix . ': ' . $message;
		}
		else
		{
			$message = static::$prefix . ': Undefined exception. Exception message is empty';
		}
		parent::__construct($message);

		LoggerAware::getLogger()->alert($message);
	}
}