<?php

session_start();

require('controller/frontend.php');

try
{
	if(isset($_GET['id']))
	{
		if(isset($_POST['newComment']) && isset($_SESSION['id']))
		{
			postComment($commentManager, $_GET['id'], $_SESSION['id'], $_POST['newComment']);
		}
		else
		{
			episode($episodeManager, $commentManager, $_GET['id']);
		}
	}
	else
	{
		episodesList($episodeManager);
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $message;
	//require('view/errorView.php');
}
