<?php

namespace projets_developpeur_web\projet_4\view;

class View
{
	protected $file;
	protected $title;
	protected $css;
	protected $javascript;

	public function __construct(array $viewData)
	{
		$this->hydrate($viewData);
	}

	public function hydrate(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set' . ucfirst($key);

			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	protected function title()
	{
		return $this->title;
	}

	protected function css()
	{
		$html = '';
		if(isset($this->css))
		{
			foreach($this->css as $script)
			{
				$html .= '<link rel="stylesheet" type= "text/css" href="' . $script . '">';
			}
		}
		return $html;
	}

	protected function javascript()
	{
		$html = '';
		if(isset($this->javascript))
		{
			foreach($this->javascript as $script)
			{
				$html .= '<script type= "text/javascript" src="' . $script . '"></script>';
			}
		}
		return $html;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function setFile($action)
	{
		$file = 'view/' . $action . 'View.php';

		if(file_exists($file))
		{
			$this->file = $file;
		}
	}

	public function setCss(array $scripts)
	{
		$css = [];

		foreach ($scripts as $script)
		{
			$scriptPath = 'assets/css/' . $script;
			if(file_exists($scriptPath))
			{
				$css[] = $scriptPath;
			}
		}
		$this->css = $css;
	}

	public function setJavascript(array $scripts)
	{
		$js = [];

		foreach ($scripts as $script)
		{
			$scriptPath = 'assets/js/' . $script;
			if(file_exists($scriptPath))
			{
				$js[] = $scriptPath;
			}
		}
		$this->javascript = $js;
	}

	public function render($data)
	{
		$content = $this->getFile($this->file, $data);
		$view = $this->getFile('view/template.php', array(
			'content' => $content,
			'title' => $this->title(),
			'css' => $this->css(),
			'javascript' => $this->javascript()));
		echo $view;
	}

	protected function getFile($file, $data)
	{
		if(file_exists($file))
		{
			extract($data);
			ob_start();
			require $file;
			return ob_get_clean();
		}
		else
		{
			throw new \Exception("File $file does not exist.");
		}
	}
}
