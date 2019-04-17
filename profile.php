<?php

session_start();

require('controller/frontend.php');

try
{
	if(isset($_GET['id']))
	{
		if(isset($_GET['edit']))
		{
			if($_SESSION['id'] === $_GET['id'])
			{
				echo 'Page en construction';
			}
			else
			{
				header('Location: profile.php?id=' . $_GET['id']);
			}
		}
		else
		{
			$id = (int) $_GET['id'];
			displayProfile($memberManager, $commentManager, $id);
		}
	}
	else
	{
		header('Location: .');
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $e;
	//require('view/errorView.php');
}
