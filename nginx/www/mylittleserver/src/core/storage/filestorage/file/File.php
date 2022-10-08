<?php

namespace Core\Storage\FileStorage\File;

class File
{
	private \SplFileInfo $file;
	protected mixed $fileData;

	public function getFileData(): string
	{
		return $this->fileData;
	}

	public function setFileData(string $plainText): void
	{
		$this->fileData = $plainText;
	}

	/**
	 * @throws FileAccessDeniedException
	 */
	public function __construct(\SplFileInfo $file)
	{
		$this->file = $file;
		if ($file->isFile())
		{
			if (!$file->isReadable() && !$file->isWritable())
			{
				throw new FileAccessDeniedException($file->getRealPath());
			}
			$this->setFileData($this->read());
		}
		else
		{
			$this->setFileData('');
		}
	}

	final protected function save(): void
	{
		file_put_contents($this->file->getRealPath(), $this->getFileData());
	}

	final protected function read(): string
	{
		return file_get_contents($this->file->getRealPath());
	}
}