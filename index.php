<?php

require('controller/frontend.php');

try
{
	homepage();
}
catch(Exception $e)
{
	$message = $e->getMessage();
	require('view/errorView.php');
}
