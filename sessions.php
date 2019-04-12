<?php

session_start();

require('controller/frontend.php');

try
{
	if(isset($_SESSION['id']))
	{
		if(isset($_GET['action']) && $_GET['action'] === 'logout')
		{
			logout();
		}
		else
		{
			header('Location: .');
		}
	}
	else
	{
		if($_GET['action'] === 'signIn')
		{
			if(isset($_POST['pseudo']) && isset($_POST['password']))
			{
				createNewMember($memberManager, $_POST['pseudo'], $_POST['password']);
			}
			else
			{
				displaySignInForm();
			}
		}
		elseif($_GET['action'] === 'login')
		{
			if(isset($_POST['pseudo']) && isset($_POST['password']))
			{
				login($memberManager, $_POST['pseudo'], $_POST['password']);
			}
			else
			{
				displayLoginForm();
			}
		}
		else
		{
			displaySignInForm();
		}
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $e;
	//require('view/errorView.php');
}
