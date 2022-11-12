<?php

namespace Core\View\Reader;

use Core\CoreException;

class ViewParser
{
	private string $content;
	private array $context;

	public function __construct(string $content, array $context = [])
	{
		$this->content = $content;
		$this->context = $context;
	}

	/**
	 * @throws CoreException
	 */
	public function getParsedView(): string
	{

		$this->parseForeaches();
		$this->parseVariables();

		return $this->content;
	}

	private function parseVariables(): void
	{
		$pattern = '/({{\s*(.*?)\s*}})/';
		$this->content = preg_replace_callback($pattern, function ($matches) {
			$variableName = VariableReader::fetchVariableName($matches[2]);
			$variableExpression = VariableReader::fetchVariableExpression($matches[2]);
			if (!isset($this->context[$variableName]))
			{
				throw new CoreException("Variable {$variableName} is not declared");
			}
			return VariableReader::readVariable($this->context[$variableName], $variableExpression);
		}, $this->content);
	}

	private function parseForeaches(): void
	{
		$pattern = '/@foreach\s*\(\s*\$[a-zA-Z\->()\d]*\s+as\s+\$\w+\s*\).*?@endforeach/s';
		$context = $this->context;
		$this->content = preg_replace_callback($pattern, static function ($matches) use ($context) {
			$foreachVars = [];
			preg_match_all('/@foreach\s*\(\s*\$([a-zA-Z\->()\d]*)\s+as\s+\$(\w+)\s*\)/', $matches[0], $foreachVars);
			preg_match_all('/@foreach\s*\(\s*\$[a-zA-Z\->()\d]*\s+as\s+\$\w+\s*\)(.*)@endforeach/s', $matches[0], $innerContent);

			$innerContent = $innerContent[1][0];
			$foreachAccumulator = $foreachVars[1][0];
			$foreachAccumulatorVarName = VariableReader::fetchVariableName($foreachAccumulator);
			$iteratorPattern = $foreachVars[2][0];
			if (!isset($context[$foreachAccumulatorVarName]))
			{
				throw new CoreException("Variable {$foreachAccumulatorVarName} is not declared");
			}

			$foreachVarsList = VariableReader::readVariable($context[$foreachAccumulatorVarName], $foreachAccumulator);

			$foreachResult = '';
			foreach ($foreachVarsList as $iterator)
			{
				$innerContext = [
					$iteratorPattern => $iterator
				] + $context;

				$foreachResult .= (new ViewParser($innerContent, $innerContext))->getParsedView();
			}

			return $foreachResult;
		}, $this->content);

		$q = 12;
	}
}