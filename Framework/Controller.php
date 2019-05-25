<?php

namespace projets_developpeur_web\projet_4\Framework;

abstract class Controller
{
	protected $action;
	protected $request;

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	public function executeAction($action)
	{
		if(method_exists($this, $action))
		{
			$this->action = $action;
			$this->{$this->action}();
		}
		else
		{
			$controllerClass = get_class($this);
			throw new \Exception("Action $action not defined in $controllerClass class");
		}
	}

	public abstract function index();

	protected function createView($viewData = array())
	{
		$controllerClass = get_class($this);
		$controller = str_replace('projets_developpeur_web\projet_4\Controller\\', '', $controllerClass);
		$controller = str_replace('Controller', '', $controller);
		//echo "<br/>$controller<br/>";
		$view = new View($this->action, $controller);
		$view->render($viewData);
	}
}
