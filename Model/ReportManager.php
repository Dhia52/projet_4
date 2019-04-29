<?php

//namespace openclassrooms\dwj\projet4\bani\model;

abstract class ReportManager
{
	abstract public function getList();
	abstract public function getReport($id);
	abstract public function send(Report $report);
	abstract public function update(Report $report);
	abstract public function delete($id);
	abstract public function exists($id);
}
