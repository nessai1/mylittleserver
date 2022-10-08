<?php

namespace Core\Storage\FileStorage;

use DirectoryIterator;

class Section
{
	protected \DirectoryIterator $directoryIterator;

	/**
	 * File that implements <b>Core\Storage\FileStorage\File\File</b> interface
	 * @var string
	 */
	protected string $classContext;

	public function __construct(\DirectoryIterator $directoryIterator, string $classContext)
	{
		if (is_dir($directoryIterator->getPath()))
		{
			$this->directoryIterator = $directoryIterator;
		}
		else
		{
			throw new SectionException("Section {$directoryIterator->getPath()} does not exists");
		}

		$this->classContext = $classContext;
	}

	/**
	 * @throws SectionException
	 */
	public function getSectionList(): array
	{
		$sectionList = [];
		/** @var DirectoryIterator $section */
		foreach ($this->directoryIterator as $section)
		{
			if ($section->isDir() && !$section->isDot())
			{
				$sectionDirectoryIterator = new DirectoryIterator($section->getPath() . DIRECTORY_SEPARATOR . $section->getFilename());
				$sectionList[$section->getFilename()] = (new Section($sectionDirectoryIterator, $this->classContext));
			}
		}

		return $sectionList;
	}

	/**
	 * @return DirectoryIterator
	 */
	public function getDirectoryIterator(): DirectoryIterator
	{
		return $this->directoryIterator;
	}

	/**
	 * @throws SectionException
	 */
	public function getSection($sectionName): Section
	{
		$sectionList = $this->getSectionList();
		if (array_key_exists($sectionName, $sectionList))
		{
			return $sectionList[$sectionName];
		}

		throw new SectionException("Section {$sectionName} does not exists");
	}


	public function isSectionExists(string $sectionName): bool
	{
		/** @var DirectoryIterator $section */
		foreach ($this->directoryIterator as $section)
		{
			if ($section->isDir() && $section->__toString() === $sectionName)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Create section with name <b>$sectionName</b>
	 * @throws SectionException
	 */
	public function createSection(string $sectionName): Section
	{
		if (!mkdir($concurrentDirectory = $this->directoryIterator->getPath() . DIRECTORY_SEPARATOR . $sectionName) && !is_dir($concurrentDirectory))
		{
			throw new SectionException("Directory {$concurrentDirectory} was not created");
		}

		return new Section(new DirectoryIterator($this->directoryIterator->getPath() . DIRECTORY_SEPARATOR . $sectionName), $this->classContext);
	}

	public function isFileExists($fileName): bool
	{
		/** @var DirectoryIterator $sectionEl */
		foreach ($this->directoryIterator as $sectionEl)
		{
			if ($sectionEl->isFile() && $sectionEl->__toString() === $fileName)
			{
				return true;
			}
		}

		return false;
	}

	public function createFile($fileName)
	{
		if ($this->isFileExists($fileName))
		{
			throw new SectionException("File {$fileName} already exists");
		}

		$filePath = $this->directoryIterator->getPath() . DIRECTORY_SEPARATOR . $fileName;
		if (!touch($filePath))
		{
			throw new SectionException("File {$filePath} was not created");
		}

		return new $this->classContext(new DirectoryIterator($filePath));
	}

	public function getFile($filename)
	{
		if ($this->isFileExists($filename))
		{
			return new $this->classContext(new \SplFileInfo($this->directoryIterator->getPath() . DIRECTORY_SEPARATOR . $filename));
		}

		throw new SectionException("File {$filename} does not exists");
	}
}