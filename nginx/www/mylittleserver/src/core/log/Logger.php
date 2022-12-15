<?php

namespace WebLab\Core\Log;

use WebLab\Core\Storage\FileStorage\File\PlainTextFile;
use WebLab\Core\Storage\FileStorage\Storage;
use WebLab\Core\Storage\FileStorage\StorageDoesNotExists;
use WebLab\Psr\Log\LoggerInterface;
use WebLab\Psr\Log\LogLevel;

class Logger implements LoggerInterface
{

	public function emergency(string $message, array $context = array())
	{
		$this->log(LogLevel::EMERGENCY, $message, $context);
	}

	public function alert(string $message, array $context = array())
	{
		$this->log(LogLevel::ALERT, $message, $context);
	}

	public function critical(string $message, array $context = array())
	{
		$this->log(LogLevel::CRITICAL, $message, $context);
	}

	public function error(string $message, array $context = array())
	{
		$this->log(LogLevel::ERROR, $message, $context);
	}

	public function warning(string $message, array $context = array())
	{
		$this->log(LogLevel::WARNING, $message, $context);
	}

	public function notice(string $message, array $context = array())
	{
		$this->log(LogLevel::NOTICE, $message, $context);
	}

	public function info(string $message, array $context = array())
	{
		$this->log(LogLevel::INFO, $message, $context);
	}

	public function debug(string $message, array $context = array())
	{
		$this->log(LogLevel::DEBUG, $message, $context);
	}

	public function log(LogLevel $level, string $message, array $context = array())
	{
		if (!self::isLoggable($level))
		{
			return;
		}

		if (Storage::isStorageExists('logs'))
		{
			$storage = Storage::getStorage('logs');
		}
		else
		{
			$storage = Storage::createStorage('logs');
		}
		$storage = $storage->setContext(PlainTextFile::class);

		$sectionName = date('y-m-d');
		if (!$storage->isSectionExists($sectionName))
		{
			$storage->createSection($sectionName);
		}

		$section = $storage->getSection($sectionName);

		$fileName = 'errors.log';
		if (!$section->isFileExists($fileName))
		{
			$file = $section->createFile($fileName);
		}
		else
		{
			$file = $section->getFile($fileName);
		}

		$file->appendRow(self::formMessage($level, $message));
	}

	protected static function formMessage(LogLevel $level, string $message): string
	{
		return '[' . date('H:m:s') . ']' . "[{$level->name}] ". $message;
	}

	protected static function isLoggable(LogLevel $level): bool
	{
		return in_array($level, [LogLevel::EMERGENCY, LogLevel::ALERT, LogLevel::CRITICAL, LogLevel::ERROR], true);
	}
}