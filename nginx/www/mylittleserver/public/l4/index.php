<?php

use Ovito\Posts\PostModel;
use Ovito\Posts\Repository\FileRepository;
require_once '../../src/autoload.php';


echo (new \Ovito\Views\DashboardView(new FileRepository()))->render();