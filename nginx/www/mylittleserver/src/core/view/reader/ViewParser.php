<?php

namespace Core\View\Reader;

class ViewParser
{
	private string $content;
	private array $context;

	public function __construct(string $content, array $context = [])
	{
		$this->content = $content;
		$this->context = $context;
	}

	public function getParsedView(): string
	{
		//$this->parseVariables();
		$this->parseForeaches();

		return $this->content;
	}

	private function parseVariables(): void
	{
		$pattern = '/{{\s*(\w+)\s*}}/';
		$this->content = preg_replace_callback($pattern, function ($matches) {
			$variableName = $matches[1];
			if (!isset($this->context[$variableName]))
			{
				throw new \Exception('Variable not found');
			}
			return $this->context[$variableName];
		}, $this->content);
	}

	private function parseForeaches(): void
	{
		$pattern = '/@foreach\s*\(\s*\$\w+\s+as\s+\$\w+\s*\).*@endforeach/';
		$this->content = preg_replace_callback($pattern, function ($matches) {
			return $foreachContent;
		}, $this->content);
	}
}