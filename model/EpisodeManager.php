<?php

//namespace openclassrooms\dwj\projet4\bani\model;

abstract class EpisodeManager
{
	abstract public function getList();
	abstract public function getEpisode($info);
	abstract public function post(Episode $episode);
	abstract public function update(Episode $episode);
	abstract public function delete($id);
	abstract public function exists(int $id);
}
