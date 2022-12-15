<?php

namespace WebLab\Psr\Log;

/**
 * Describes a logger-aware instance.
 */
interface LoggerAwareInterface
{
	/**
	 * Sets a logger instance
	 *
	 * @param LoggerInterface $logger
	 * @return void
	 */
	public static function setLogger(LoggerInterface $logger): void;
}