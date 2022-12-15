<?php

require_once '../../../src/autoload.php';

use \WebLab\Ovito\Posts\Repository\FileRepository;


(new \WebLab\Ovito\Pages\OvitoDashboard(new FileRepository()))->run();