<?php

declare(strict_types=1);

namespace App;

require_once('src/utils/dump.php');
require_once('src/Controller.php');
require_once('src/Request.php');

$request = new Request($_POST, $_GET);

(new Controller($request)) -> run();