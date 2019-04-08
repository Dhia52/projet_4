<?php

session_start();

require('controller/frontend.php');


try
{
	homepage($episodeManager, $memberManager);
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $e;
	//require('view/errorView.php');
}
