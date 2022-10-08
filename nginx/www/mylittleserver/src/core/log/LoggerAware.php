<?php

namespace Core\Log;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

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