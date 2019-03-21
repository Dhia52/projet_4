<?php

function loadClass($class)
{
	require('model/' . $class . '.php');
}

spl_autoload_register('loadClass');

function homepage()
{
	require('view/home.php');
}
