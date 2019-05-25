<?php

namespace projets_developpeur_web\projet_4\Framework;

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

		$root = $_SERVER['DOCUMENT_ROOT'] . Configuration::get('root');
		$controllerPath = $root . 'Controller/' . $controller . 'Controller';
		$controllerFile = $controllerPath . '.php';

		if(file_exists($controllerFile))
		{
			$controllerClass = \str_replace($_SERVER['DOCUMENT_ROOT'], '', $controllerPath);

			$controllerClass = \str_replace('/', '\\', $controllerClass);
			$controller = new $controllerClass();
			$controller->setRequest($request);
			return $controller;
		}
		else
		{
			throw new \Exception("Error 404: This file does not exist");
		}
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
