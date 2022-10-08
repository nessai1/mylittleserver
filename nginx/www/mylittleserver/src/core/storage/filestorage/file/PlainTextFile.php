<?php

namespace Core\Storage\FileStorage\File;

class PlainTextFile extends File
{
	public function appendRow(string $row): void
	{
		$this->setFileData($this->getFileData() . PHP_EOL . $row);
		$this->save();
	}

	public function __construct(\SplFileInfo $file)
	{
		parent::__construct($file);
	}
}