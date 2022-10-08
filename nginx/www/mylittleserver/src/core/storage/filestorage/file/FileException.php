<?php

namespace Core\Storage\FileStorage\File;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class FileException extends \Exception
{
	private string $filePath;
	private const FILE_EXCEPTION_PREFIX = "[FILE ERROR]";

	public function __construct(string $filePath, string $message = "")
	{
		if ($message)
		{
			$message = self::FILE_EXCEPTION_PREFIX . ': ' . $message;
		}
		else
		{
			$message = self::FILE_EXCEPTION_PREFIX . ": Undefined error";
		}
		parent::__construct($message);
		$this->filePath = $filePath;
	}

	public function getFilePath(): string
	{
		return $this->filePath;
	}
}