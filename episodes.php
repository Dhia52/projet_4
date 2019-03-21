<?php

require('controller/frontend.php');

try
{
}
catch(Exception $e)
{
	$message = $e->getMessage();
	require('view/errorView.php');
}
