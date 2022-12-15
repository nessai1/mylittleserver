<?php

namespace WebLab\Ovito\Pages;

use WebLab\Core\Page\Page;
use WebLab\Core\Page\SinglePageApplication;
use WebLab\Core\Storage\Repository\Repository;
use WebLab\Ovito\Rest\DashboardHandler;
use WebLab\Ovito\Views\DashboardView;

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