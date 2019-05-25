<?php

namespace projets_developpeur_web\projet_4;

use projets_developpeur_web\projet_4\Framework\Router;

session_start();

require('Framework/Autoloader.php');

Autoloader::register();

$router = new Router();
$router->routeRequest();
