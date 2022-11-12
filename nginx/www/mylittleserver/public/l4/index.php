<?php
require_once '../../src/autoload.php';

use Ovito\Posts\Repository\FileRepository;


(new \Ovito\Pages\OvitoDashboard(new FileRepository()))->run();