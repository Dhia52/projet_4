<?php

//namespace openclassrooms\dwj\projet4\bani\model;

class Report
{
	private $id;
	private $commentId;
	private $report;
	private $reportDate;

	public function __construct(array $reportData)
	{
		$this->hydrate($reportData);
	}

	public function hydrate(array $reportData)
	{
		foreach ($reportData as $key => $value)
		{
			$method = 'set' . ucfirst($key);
			
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function id()
	{
		return $this->id;
	}
	
	public function commentId()
	{
		return $this->commentId;
	}
	
	public function report()
	{
		return $this->report;
	}
	
	public function reportDate()
	{
		return $this->reportDate;
	}
	
	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
		else
		{
			throw new \Exception('Incorrect id value');
		}
	}
	
	public function setCommentId($commentId)
	{
		$commentId = (int) $commentId;

		if ($commentId > 0)
		{
			$this->commentId = $commentId;
		}
		else
		{
			throw new \Exception('Incorrect id value');
		}
	}
	
	public function setReport($report)
	{
		/*if (strlen($pass) >= 8)
		{
			$this->content = $text;
		}
		else
		{
			throw new Exception('Weak password');
		}*/
	}
	
	public function setReportDate($reportDate)
	{
		if ($reportDate > time())
		{
			$this->reportDate = $reportDate;
		}
		else
		{
			throw new \Exception('Incorrect date value');
		}
	}
}
