<?php

session_start();

require('controller/frontend.php');

try
{
	if(isset($_GET['id']))
	{
		episode($episodeManager, $commentManager, $_GET['id']);
	}
	else
	{
		episodesList($episodeManager);
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	require('view/errorView.php');
}
