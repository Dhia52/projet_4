<?php

namespace openclassrooms\dwj\projet4\bani;

session_start();

require('controller/frontend.php');

try
{
	homepage($episodeManager);
}
catch(Exception $e)
{
	$message = $e->getMessage();
	echo $e;
	//require('view/errorView.php');
}
