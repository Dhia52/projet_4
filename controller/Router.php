<?php

namespace projets_developpeur_web\projet_4\controller;

//session_start();

class Router
{
	protected $homeCntrl;
	protected $episodesCntrl;

	public function __construct()
	{
		$this->homeCntrl = new HomeController();
	}

	public function routeRequest()
	{
		try
		{
			$this->homeCntrl->homepage();
		}
		catch(\Exception $e)
		{
			$this->error($e->getMessage());
		}
	}

	protected function error($message)
	{
		$view = new view\View('error');
		$view->render(array('message' => $message));
	}
}
