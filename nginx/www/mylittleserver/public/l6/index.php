<?php
require_once '../../src/autoload.php';


(new WebLab\Ovito\Pages\OvitoDashboard(new WebLab\Ovito\Posts\Repository\Integration\GoogleTableRepository()))->run();