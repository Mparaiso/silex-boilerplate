<?php

$app = require_once(dirname(__DIR__)."/Application/application.php");

$app['http_cache']->run();
