<?php

namespace WebLab\Core\View;

use WebLab\Core\View\Reader\ViewReader;

class View implements ViewInterface
{
	private string $componentName;
	private array $context;

	public function __construct($componentName, array $context = [])
	{
		$this->componentName = $componentName;
		$this->context = $context;
	}

	public function getContent(): string
	{
		return (new ViewReader($this->componentName, $this->context))->render();
	}
}