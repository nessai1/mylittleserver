<?php

namespace Core\Storage\FileStorage\File;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

final class FileAccessDeniedException extends FileException
{
	public function __construct(string $filePath)
	{
		parent::__construct($filePath, "Access denied to file {$filePath}");
	}
}