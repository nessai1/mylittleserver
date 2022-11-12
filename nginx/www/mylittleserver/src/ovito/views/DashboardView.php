<?php

namespace Ovito\Views;

use Core\View\View;

class DashboardView
{
	public function render(): string
	{
		return (new View('ovito'))->getContent();
	}
}