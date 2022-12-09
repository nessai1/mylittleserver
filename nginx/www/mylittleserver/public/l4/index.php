<?php
require_once '../../src/autoload.php';


(new \Ovito\Pages\OvitoDashboard(new \Ovito\Posts\Repository\DatabaseRepository()))->run();