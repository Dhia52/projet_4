<?php

namespace projets_developpeur_web\projet_4\Framework;

use projets_developpeur_web\projet_4\Controller as Controller;

class Router
{
	public function routeRequest()
	{
		try
		{
			$request = new Request(array_merge($_GET, $_POST));
			$controller = $this->createController($request);
			$action = $this->createAction($request);

			$controller->executeAction($action);
		}
		catch(\Exception $e)
		{
			$this->error($e->getMessage());
		}
	}

	protected function createController(Request $request)
	{
		$controller = 'Home'; //default controller
		
		if($request->exists('controller'))
		{
			$controller = $request->getParam('controller');
			$controller = ucfirst(strtolower($controller));
		}

		$controllerClass = 'projets_developpeur_web\projet_4\Controller\\' . $controller . 'Controller';
		$controller = new $controllerClass();
		$controller->setRequest($request);
		return $controller;
	}

	protected function createAction(Request $request)
	{
		$action = 'index'; //default action
		if($request->exists('action'))
		{
			$action = $request->getParam('action');
		}
		return $action;
	}

	protected function error($message)
	{
		$view = new View('error');
		$view->render(array('message' => $message));
	}
}
