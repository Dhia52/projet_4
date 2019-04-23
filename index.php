<?php

namespace projets_developpeur_web\projet_4;

use projets_developpeur_web\projet_4 as project;

session_start();

require('Autoloader.php');
Autoloader::register();

$router = new controller\Router();
$router->routeRequest();
