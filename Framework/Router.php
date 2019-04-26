<?php

namespace projets_developpeur_web\projet_4\Framework;

use projets_developpeur_web\projet_4\controller as controller;

class Router
{
	protected $homeCntrl;
	protected $episodesCntrl;

	public function __construct()
	{
		$this->homeCntrl = new controller\HomeController();
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

	protected function getParams($array, $key)
	{
		if(isset($array[$key]))
		{
			return $array[$key];
		}
		else
		{
			throw new \Exception("Parameter $key not found.");
		}
	}
}
