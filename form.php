<?php

session_start();

require('controller/frontend.php');

try
{
	if(isset($_GET['action']))
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
			displayLoginForm();
		}
		elseif($_GET['action'] === 'logout')
		{
			logout();
		}
	}
	else
	{
		displaySignInForm();
	}
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $e;
	//require('view/errorView.php');
}
