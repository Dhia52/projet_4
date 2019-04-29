<?php

namespace projets_developpeur_web\projet_4;

session_start();

require('Framework/Autoloader.php');
Autoloader::register();

$router = new Framework\Router();
$router->routeRequest();
