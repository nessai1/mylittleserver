<?php

namespace WebLab\Core\View\Reader;

final class VariableReader
{
	/**
	 * @throws \Core\CoreException
	 */
	public static function readVariable(mixed $variable, string $variableName): mixed
	{
		if (preg_match('/^([a-zA-Z0-9_]+)$/', $variableName))
		{
			return $variable;
		}
		else if (preg_match('/^([a-zA-Z0-9_](->)?+)+(\(\))?$/', $variableName))
		{
			$resultVariable = preg_replace('/^([a-zA-Z_0-9]+)/', '$variable', $variableName, 1);
			return eval("return {$resultVariable};");
		}

		throw new \Core\CoreException('Undefined pattern of variable');
	}

	public static function fetchVariableName(string $variable): string
	{
		$variableName = preg_match('/^\$?(\w)*/', $variable, $matches) ? $matches[0] : '';
		if ($variableName[0] === '$')
		{
			$variableName = substr($variableName, 1);
		}

		return $variableName;
	}

	public static function fetchVariableExpression(string $expression): string
	{
		$fetchedExpression =  preg_match('/^\$?([a-zA-Z0-9_](->)?+)+(\(\))?$/', $expression, $matches) ? $matches[0] : '';
		if ($fetchedExpression[0] === '$')
		{
			$fetchedExpression = substr($fetchedExpression, 1);
		}
		return $fetchedExpression;
	}
}