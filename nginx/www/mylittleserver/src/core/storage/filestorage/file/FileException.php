<?php

namespace WebLab\Core\Storage\FileStorage\File;

use WebLab\Core\CoreException;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class FileException extends CoreException
{
	protected static string $prefix = "[FILE ERROR]";

	public function __construct(string $message = "")
	{
		parent::__construct($message);
	}
}