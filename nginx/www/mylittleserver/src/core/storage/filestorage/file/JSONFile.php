<?php

namespace WebLab\Core\Storage\FileStorage\File;

class JSONFile extends File
{
	public function __construct(\SplFileInfo $file)
	{
		parent::__construct($file);
	}

	public function setFileData(string $plainText): void
	{
		if ($plainText === '')
		{
			$plainText = '{}';
		}
		try
		{
			json_decode($plainText, true, 512, JSON_THROW_ON_ERROR);
		}
		catch (\JsonException $e)
		{
			throw new FileException("Invalid JSON data for file {$this->file->getRealPath()}");
		}

		parent::setFileData($plainText);
	}

	public function getJsonData()
	{
		return json_decode($this->getFileData(), true, 512, JSON_THROW_ON_ERROR);
	}

	public function setJsonData(array $data): void
	{
		$this->setFileData(json_encode($data, JSON_THROW_ON_ERROR));
	}
}