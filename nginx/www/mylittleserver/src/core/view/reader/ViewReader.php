<?php

namespace WebLab\Core\View\Reader;

final class ViewReader
{
	private string $componentName;
	private array $context;

	public function __construct(string $componentName, array $context = [])
	{
		$this->componentName = $componentName;
		$this->context = $context;
	}

	public function render(): string
	{
		$path = $this->getComponentPath();
		$content = self::readComponent($path);

		return (new ViewParser($content, $this->context))->getParsedView();
	}

	public function setComponentName(string $componentName): void
	{
		$this->componentName = $componentName;
	}

	public function getComponentName(): string
	{
		return $this->componentName;
	}

	private function getComponentPath(): string
	{
		$path = self::buildComponentPath($this->componentName);
		if (!file_exists($path))
		{
			throw new \Core\CoreException("Component {$this->componentName} not found");
		}

		return $path;
	}

	private static function readComponent(string $path): string
	{
		return file_get_contents($path);
	}

	private static function buildComponentPath(string $componentName): string
	{
		$componentName = str_replace('\\', '/', $componentName);
		return __DIR__ . '/../../../../views/' . $componentName . '.blade.php'; // TODO: исправить формирование на нормальное, мне влом пока
	}
}