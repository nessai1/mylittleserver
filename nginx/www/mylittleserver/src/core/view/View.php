<?php

namespace Core\View;

use Core\View\Reader\ViewReader;

class View
{
	public function __construct($componentName)
	{
		$this->componentName = $componentName;
	}

	public function getContent()
	{
		return (new ViewReader($this->componentName))->render();
	}
}