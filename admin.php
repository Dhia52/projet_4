<?php

require('controller/backend.php');

try
{
	kytf
}
catch(Exception $e)
{
	$message = $e->getMessage();
	require('view/errorView.php');
}
