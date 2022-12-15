<?php

namespace WebLab\Core\Log;

use \WebLab\Psr\Log\LoggerAwareInterface;
use \WebLab\Psr\Log\LoggerInterface;

final class LoggerAware implements LoggerAwareInterface
{
	private static LoggerInterface $logger;

	public static function getLogger(): LoggerInterface
	{
		if (!isset(self::$logger))
		{
			self::$logger = new Logger();
		}

		return self::$logger;
	}

	public static function setLogger(LoggerInterface $logger): void
	{
		self::$logger = $logger;
	}
}