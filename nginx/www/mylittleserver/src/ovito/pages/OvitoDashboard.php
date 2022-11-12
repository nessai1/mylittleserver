<?php

namespace Ovito\Pages;

use Core\Page\Page;
use Core\Page\SinglePageApplication;
use Core\Storage\Repository\Repository;
use Ovito\Rest\DashboardHandler;
use Ovito\Views\DashboardView;

final class OvitoDashboard implements Page
{
	private SinglePageApplication $spa;

	public function __construct(Repository $repository)
	{
		$this->spa = new SinglePageApplication(
			new DashboardView($repository),
			new DashboardHandler($repository),
		);
	}

	public function run(): void
	{
		$this->spa->run();
	}
}